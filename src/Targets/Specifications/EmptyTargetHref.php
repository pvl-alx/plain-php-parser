<?php

namespace Targets\Specifications;

/**
 * Class EmptyTargetHref
 * @package Targets\Specifications
 */
class EmptyTargetHref extends ATagSpecification
{
    /**
     * @return bool
     */
    public function isSatisfiedBy(): bool
    {
        return empty($this->href);
    }
}