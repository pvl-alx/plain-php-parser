#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use Commands\Report;

$report = new Report();
echo $report->execute() . PHP_EOL;