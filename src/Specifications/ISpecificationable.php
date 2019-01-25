<?php

namespace Specifications;

/**
 * Interface ISpecificationable
 * @package Specifications
 */
interface ISpecificationable
{
    /**
     * @return bool
     */
    public function isSatisfiedBy(): bool;
}
