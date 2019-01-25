<?php

namespace Parsers;

/**
 * Interface IParseble
 * @package Parsers
 */
interface IParseble
{
    /**
     * @param string $target
     * @return mixed
     */
    public function parse(string $target);
}
