<?php

namespace Parsers;

use DOMDocument;
use Exception;
use Results\Persistence\CsvPersistence;
use Results\Repositories\ResultRepository;
use Results\Result;
use Results\ResultCollection;
use Specifications\AndSpecification;
use Specifications\NotSpecification;
use Specifications\OrSpecification;
use Targets\Factories\HtmlTargetFactory;
use Targets\Specifications\EmptyHtmlTargetHost;
use Targets\Specifications\EmptyTargetHref;
use Targets\Specifications\TargetContainsSourcesPath;
use Targets\Specifications\TargetContainsUrlHash;
use Targets\Specifications\TargetSourceMatch;
use Url\Url;
use Url\UrlCollection;
use Url\UrlGenerator;

/**
 * Class HtmlParser
 * @package Parsers
 */
class HtmlParser implements IParseble
{
    /**
     * @var Url
     */
    private $source;

    /**
     * @var array
     */
    private $config;

    /**
     * @var ResultRepository[]
     */
    private $repositories;

    /**
     * @var UrlCollection
     */
    private $searchSources;

    /**
     * @var ResultCollection
     */
    private $results;

    /**
     * HtmlParser constructor.
     * @param Url $source
     * @param array $config
     * @param ResultRepository ...$repositories
     */
    public function __construct(Url $source, array $config, ResultRepository...$repositories)
    {
        $this->source = $source;
        $this->config = $config;
        $this->repositories = $repositories;

        $this->searchSources = new UrlCollection();
        $this->searchSources->append($source);

        $this->results = new ResultCollection();
    }

    /**
     * @param string $targetAlias
     * @return mixed
     * @throws \Exception
     */
    public function parse(string $targetAlias)
    {
        $this->checkTargetAlias($targetAlias);
        $this->getSources();
        $this->findTarget($targetAlias);
        $this->save();

        try {
            return $this->getResult();
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     *
     */
    private function getSources()
    {
        $html = file_get_contents($this->source->getUrl());

        $basePage = new DOMDocument();
        $basePage->loadHTML($html);

        foreach ($basePage->getElementsByTagName('a') as $innerSource) {
            $andSpecification = new AndSpecification(
                new NotSpecification(new EmptyTargetHref($innerSource)),
                new OrSpecification(
                    new EmptyHtmlTargetHost($innerSource),
                    new TargetSourceMatch($innerSource, $this->source)
                ),
                new AndSpecification(
                    new NotSpecification(new TargetContainsUrlHash($innerSource)),
                    new NotSpecification(new TargetContainsSourcesPath($innerSource, $this->source))
                )
            );

            if ($andSpecification->isSatisfiedBy()) {
                $url = (new UrlGenerator($innerSource->getAttribute('href'), $this->source->getHost()))->generate();

                $this->searchSources->append($url);
            }
        }

        $this->searchSources = $this->searchSources->unique();
    }

    /**
     * @param string $targetAlias
     */
    private function findTarget(string $targetAlias)
    {
        foreach ($this->searchSources as $validSource) {
            $html = file_get_contents($validSource->getUrl());
            $dom = new DOMDocument;
            $dom->loadHTML($html);

            foreach ($dom->getElementsByTagName($targetAlias) as $item) {
                $target = (new HtmlTargetFactory($this->config, $item))->factory($targetAlias);
                if (! empty($target->getTargetValue())) {
                    $this->results->append(Result::draft(
                        $validSource,
                        $target
                    ));
                }
            }
        }
    }

    /**
     * @param string $targetAlias
     */
    private function checkTargetAlias(string $targetAlias)
    {
        if (! array_key_exists($targetAlias, $this->config)) {
            throw new \InvalidArgumentException($targetAlias. 'is invalid target alias. ' . implode(',', $this->config) . ' expected!');
        }
    }

    /**
     *
     */
    private function save()
    {
        foreach ($this->repositories as $repository) {
            $repository->saveBatch($this->results);
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function getResult()
    {
        $csvRepo = new ResultRepository(new CsvPersistence($this->source));
        return $csvRepo->findBatch();
    }
}