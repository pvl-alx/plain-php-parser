<?php

namespace Targets;

/**
 * Interface ITargetable
 * @package Targets
 */
interface ITargetable
{
    /**
     * @return mixed
     */
    public function getTargetValue();

    /**
     * @return string
     */
    public function getAlias() : string;
}
