<?php

namespace Url\Specifications;

use Specifications\ISpecificationable;

/**
 * Class UrlSpecification
 * @package Url\Specifications
 */
abstract class UrlSpecification implements ISpecificationable
{
    /**
     * @var
     */
    protected $rawUrl;

    /**
     * UrlSpecification constructor.
     * @param $rawUrl
     */
    public function __construct($rawUrl)
    {
        $this->rawUrl = $rawUrl;
    }

    /**
     * @return bool
     */
    abstract public function isSatisfiedBy(): bool;
}