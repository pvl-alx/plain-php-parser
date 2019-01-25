<?php

namespace Url;

/**
 * Class Url
 * @package ValueObjects
 */
class Url
{
    /**
     * @var string
     */
    private $url;

    /**
     * @param string $url
     * @return Url
     */
    public static function fromString(string $url) : Url
    {
        self::ensureIsValidUrl($url);

        return new self($url);
    }

    /**
     * Url constructor.
     * @param string $url
     */
    private function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param string $url
     */
    private static function ensureIsValidUrl(string $url)
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid url');
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        $urlArr = parse_url($this->url);

        return $urlArr['host'];
    }
}