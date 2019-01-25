<?php

namespace Commands;

/**
 * Class Command
 * @package Commands
 */
interface ICommand
{
    /**
     * @return mixed
     */
    public function execute();
    /**
     * @return array
     */
    public function getArguments() : array;

    /**
     * @return string
     */
    public function getAlias() : string;
}