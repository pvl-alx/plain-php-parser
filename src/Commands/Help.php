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
class Help implements ICommand
{
    /**
     * @var array. Array of command arguments
     */
    protected $arguments = [];

    /**
     * @var string
     */
    private $alias = 'help';

    /**
     * @return array|mixed|string
     */
    public function execute()
    {
        $helpMessage = 'parse - запускает парсер, принимает обязательный параметр url (как с протоколом, так и без).' . PHP_EOL;
        $helpMessage .= 'report - выводит в консоль результаты анализа для домена, принимает обязательный параметр domain (как с протоколом, так и без).' . PHP_EOL;
        $helpMessage .= 'help - выводит список команд с пояснениями.';

        return $helpMessage;
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