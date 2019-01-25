<?php

namespace Commands;

use Exception;
use Options\OptionsDetector;
use Results\Persistence\CsvPersistence;
use Results\Repositories\ResultRepository;

/**
 * Class Report
 * @package Commands
 */
class Report implements ICommand
{
    /**
     * @var array. Array of command arguments
     */
    protected $arguments = ['domain:',];

    /**
     * @var string
     */
    private $alias = 'report';

    /**
     * @return array|mixed|string
     */
    public function execute()
    {
        try {
            $option = OptionsDetector::detect($this);
            $csvRepo = new ResultRepository(new CsvPersistence($option));

            return $csvRepo->findBatch();
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @return string
     */
    public function getAlias() : string
    {
        return $this->alias;
    }

    /**
     * @return array
     */
    public function getArguments() : array
    {
        return $this->arguments;
    }
}