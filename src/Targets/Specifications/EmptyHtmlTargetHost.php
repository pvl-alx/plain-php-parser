<?php

namespace Targets\Specifications;

use DOMElement;

/**
 * Class EmptyHtmlTargetHost
 * @package Targets\Specifications
 */
class EmptyHtmlTargetHost extends ATagSpecification
{
    /**
     * @return bool
     */
    public function isSatisfiedBy(): bool
    {
        $tempUrl = parse_url($this->href);

        return empty($tempUrl['host']);
    }
}