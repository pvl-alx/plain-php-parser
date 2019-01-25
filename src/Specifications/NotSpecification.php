<?php

namespace Specifications;

/**
 * Class NotSpecification
 * @package Specifications
 */
class NotSpecification implements ISpecificationable
{
    /**
     * @var ISpecificationable
     */
    private $specification;

    /**
     * NotSpecification constructor.
     * @param ISpecificationable $specification
     */
    public function __construct(ISpecificationable $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(): bool
    {
        return ! $this->specification->isSatisfiedBy();
    }
}
