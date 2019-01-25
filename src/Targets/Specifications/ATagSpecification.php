<?php

namespace Targets\Specifications;

use DOMElement;
use Specifications\ISpecificationable;

/**
 * Class ATagSpecification
 * @package Targets\Specifications
 */
abstract class ATagSpecification implements ISpecificationable
{
    /**
     * @var DOMElement
     */
    protected $aTag;

    /**
     * @var string
     */
    protected $href;

    /**
     * ATagSpecification constructor.
     * @param DOMElement $aTag
     */
    public function __construct(DOMElement $aTag)
    {
        if ($aTag->tagName !== 'a') {
            throw new \InvalidArgumentException('In ' . __CLASS__ . ' element should by type of IMG. ' . $aTag->tagName . 'given.');
        }

        $this->aTag = $aTag;
        $this->href = $aTag->getAttribute('href');
    }

    /**
     * @return bool
     */
    abstract public function isSatisfiedBy(): bool;
}