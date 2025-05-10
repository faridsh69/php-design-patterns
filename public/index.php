<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Laravel\ServiceContainer;

$container = new ServiceContainer();
$container->run();
