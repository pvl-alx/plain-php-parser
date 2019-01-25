<?php

namespace Commands;

use Exception;
use Options\OptionsDetector;
use Parsers\HtmlParser;
use Results\Persistence\CsvPersistence;
use Results\Persistence\DbPersistence;
use Results\Repositories\ResultRepository;
use Targets\Img;

/**
 * Class Parse
 * @package Commands
 */
class Parse implements ICommand
{
    /**
     * @var array. Array of command arguments
     */
    protected $arguments = ['url:',];

    /**
     * @var string
     */
    private $alias = 'parse';

    /**
     * @return array|mixed|string
     * @throws Exception
     */
    public function execute()
    {
        try {
            $option = OptionsDetector::detect($this);
            $parser = new HtmlParser(
                $option,
                ['img' => Img::class],
                new ResultRepository(new DbPersistence()),
                new ResultRepository(new CsvPersistence($option))
            );
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

        return $parser->parse('img');
    }

    /**
     * @return string
     */
    public function getAlias() : string
    {
        return $this->alias;
    }

    /**
     * @return array
     */
    public function getArguments() : array
    {
        return $this->arguments;
    }
}