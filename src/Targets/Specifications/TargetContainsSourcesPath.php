<?php

namespace Targets\Specifications;

use DOMElement;
use Url\Url;

/**
 * Class TargetContainsSourcesPath
 * @package Targets\Specifications
 */
class TargetContainsSourcesPath extends ATagSpecification
{
    /**
     * @var Url
     */
    private $source;

    /**
     * TargetContainsSourcesPath constructor.
     * @param DOMElement $aTag
     * @param Url $source
     */
    public function __construct(DOMElement $aTag, Url $source)
    {
        parent::__construct($aTag);
        $this->source = $source;
    }

    /**
     * @return bool
     */
    public function isSatisfiedBy(): bool
    {
        $tempUrl = parse_url($this->href);
        $sourcesTempUrl = parse_url($this->source->getUrl());

        return $tempUrl['path'] === $sourcesTempUrl['path'];
    }
}