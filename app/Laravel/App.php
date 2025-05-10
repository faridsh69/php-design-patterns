<?php

namespace App\Laravel;

use App\Controllers\UserController;

final class App
{
  public static function run()
  {
    $serviceContainer = new ServiceContainer();

    $serviceProvider = new ServiceProvider($serviceContainer);
    $serviceProvider->register();
    $serviceProvider->boot();

    $controller = $serviceContainer->getInstance(UserController::class);
    $controller->index();
  }
}
