<?php

namespace Url;

use Generators\IGeneratable;
use Specifications\AndSpecification;
use Specifications\NotSpecification;
use Url\Specifications\UrlContainsScheme;
use Url\Specifications\UrlStartFromPath;

/**
 * Class UrlGenerator
 * @package Url
 */
class UrlGenerator implements IGeneratable
{
    /**
     *
     */
    const DEFAULT_SCHEME = 'http://';

    /**
     *
     */
    const DEFAULT_PATH = '/';

    /**
     * @var
     */
    private $rawUrl;

    /**
     * @var string
     */
    private $test;

    /**
     * UrlGenerator constructor.
     * @param string $rawUrl
     * @param string $defaultHost
     */
    public function __construct(string $rawUrl, string $defaultHost = '')
    {
        if (empty($rawUrl)) {
            throw new \InvalidArgumentException("Empty url base");
        }

        $andSpec = new AndSpecification(
            new NotSpecification(new UrlContainsScheme($rawUrl)),
            new NotSpecification(new UrlStartFromPath($rawUrl))
        );

        if ($andSpec->isSatisfiedBy()) {
            $rawUrl = self::DEFAULT_SCHEME . $rawUrl;
        }

        $tempUrl = parse_url($rawUrl);

        if (empty($tempUrl['host']) && empty($defaultHost)) {
            throw new \InvalidArgumentException("Empty host name, can't build url");
        }
        $rawUrlData['scheme'] = empty($tempUrl['scheme']) ? self::DEFAULT_SCHEME : $tempUrl['scheme'] . '://';
        $rawUrlData['host'] = empty($tempUrl['host']) ? $defaultHost : $tempUrl['host'];
        $rawUrlData['path'] = empty($tempUrl['path']) ? self::DEFAULT_PATH : $tempUrl['path'];

        $this->rawUrl = $rawUrlData;
        $this->test = $rawUrl;
    }

    /**
     * @return mixed|Url
     */
    public function generate()
    {
        $url = $this->rawUrl['scheme'] . $this->rawUrl['host'] . $this->rawUrl['path'];

        return Url::fromString($url);
    }
}