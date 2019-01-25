<?php

namespace Targets\Specifications;

/**
 * Class TargetContainsUrlHash
 * @package Targets\Specifications
 */
class TargetContainsUrlHash extends ATagSpecification
{
    /**
     * @return bool
     */
    public function isSatisfiedBy(): bool
    {
        return strpos($this->href, '#');
    }
}