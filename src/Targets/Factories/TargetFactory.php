<?php

namespace Targets\Factories;

/**
 * Class TargetFactory
 * @package Targets\Factories
 */
abstract class TargetFactory implements IFactoriable
{
    /**
     * @var array
     */
    protected $config;

    /**
     * TargetFactory constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $alias
     * @return mixed
     */
    protected function findClassByAlias(string $alias)
    {
        if (! array_key_exists($alias, $this->config)) {
            throw new \InvalidArgumentException($alias. 'is invalid target alias.');
        }

        return $this->config[$alias];

    }

    /**
     * @param string $alias
     * @return mixed
     */
    abstract public function factory(string $alias);
}