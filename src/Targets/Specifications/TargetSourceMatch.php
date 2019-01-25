<?php

namespace Targets\Specifications;

use DOMElement;
use Url\Url;

/**
 * Class TargetSourceMatch
 * @package Targets\Specifications
 */
class TargetSourceMatch extends ATagSpecification
{
    /**
     * @var Url
     */
    private $source;

    /**
     * TargetSourceMatch constructor.
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

        return $tempUrl['host'] === $this->source->getHost();
    }
}
