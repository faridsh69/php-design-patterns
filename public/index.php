<?php

require __DIR__ . '/../vendor/autoload.php';

function dd(...$vars)
{
  foreach ($vars as $var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
  }
  die(1);
}

use App\Laravel\App;

$app = new App();
$app->run();
