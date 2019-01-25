<?php

namespace Targets\Factories;

use DOMElement;

/**
 * Class HtmlTargetFactory
 * @package Targets\Factories
 */
class HtmlTargetFactory extends TargetFactory
{
    /**
     * @var DOMElement
     */
    private $element;

    /**
     * HtmlTargetFactory constructor.
     * @param array $config
     * @param DOMElement $element
     */
    public function __construct(array $config, DOMElement $element)
    {
        parent::__construct($config);

        $this->element = $element;
    }

    /**
     * @param string $alias
     * @return mixed
     */
    public function factory(string $alias)
    {
        $class = $this->findClassByAlias($alias);
        return new $class($this->element);
    }
}
