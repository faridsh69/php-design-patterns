<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/Laravel/HelperMethods.php';

use App\Laravel\App;

$app = new App();
$result = $app->run();

dd($result);
