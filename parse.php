#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';
libxml_use_internal_errors(true);

use Commands\Parse;

$parseCommand = new Parse();
echo  $parseCommand->execute() . PHP_EOL;
