<?php

namespace Targets\Factories;

/**
 * Interface IFactoriable
 * @package Targets\Factories
 */
interface IFactoriable
{
    /**
     * @param string $alias
     * @return mixed
     */
    public function factory(string $alias);
}
