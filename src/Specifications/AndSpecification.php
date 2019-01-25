<?php

namespace Specifications;

/**
 * Class AndSpecification
 * @package Targets\Specifications
 */
class AndSpecification implements ISpecificationable
{
    /**
     * @var ISpecificationable[]
     */
    private $specifications;

    /**
     * AndSpecification constructor.
     * @param ISpecificationable ...$specifications
     */
    public function __construct(ISpecificationable ...$specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * if at least one specification is true, return true, else return false
     *
     * @return bool
     */
    public function isSatisfiedBy(): bool
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy()) {
                return false;
            }
        }

        return true;
    }
}
