<?php

use Booster\Console\GenerateAllCommand;
use Symfony\Component\Console\Application;

include('vendor/autoload.php');


$app = new Application();
$app->add(new GenerateAllCommand());
$app->run();