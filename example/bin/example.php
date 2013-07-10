#!/usr/bin/env php
<?php

use Symfony\Component\Console\Application;
use CBerube\Console\Menu\Example\Command\SimpleMenu;

$loader = require __DIR__ . '/../../vendor/autoload.php';
$loader->add('CBerube', __DIR__ . '/../src/');

$simpleMenuCommand = new SimpleMenu();

$application = new Application();
$application->add($simpleMenuCommand);
$application->run();
