#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use Commands\Help;

$help = new Help();
echo $help->execute() . PHP_EOL;