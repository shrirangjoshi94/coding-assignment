<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Src\Command\RobotCleanCommand;

$app = new Application('Robot CLean Floor Application');
$app->add(new RobotCleanCommand());
$app->run();