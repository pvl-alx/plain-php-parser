<?php

namespace Targets;

use DOMElement;

/**
 * Class Img
 * @package Targets
 */
class Img implements ITargetable
{
    /**
     * @var string
     */
    private $alias = 'img';

    /**
     * @var DOMElement
     */
    private $element;

    /**
     * @param DOMElement $element
     */
    public function __construct(DOMElement $element)
    {
        $this->element = $element;
    }

    /**
     * @return string
     */
    public function getTargetValue()
    {
        if (empty($this->element)) {
            throw new \InvalidArgumentException('Goal must have element for result. Set it !');
        }

        return $this->element->getAttribute('src');
    }

    /**
     * @return string
     */
    public function getAlias() : string
    {
        return $this->alias;
    }

    /**
     * @return DOMElement
     */
    public function getElement()
    {
        return $this->element;
    }
}
