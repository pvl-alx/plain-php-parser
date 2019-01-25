<?php

namespace Url\Specifications;

use Url\UrlGenerator;

/**
 * Class UrlStartFromPath
 * @package Url\Specifications
 */
class UrlStartFromPath extends UrlSpecification
{
    /**
     * @return bool
     */
    public function isSatisfiedBy(): bool
    {
        return $this->rawUrl[0] === UrlGenerator::DEFAULT_PATH;
    }
}
