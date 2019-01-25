<?php

namespace Url\Specifications;

/**
 * Class UrlContainsScheme
 * @package Url\Specifications
 */
class UrlContainsScheme extends UrlSpecification
{
    /**
     * @return bool
     */
    public function isSatisfiedBy(): bool
    {
        return strpos($this->rawUrl, "://") !== false;
    }
}
