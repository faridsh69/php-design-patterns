<?php

namespace App\Laravel;

final class App
{
  public static function run()
  {
    // init container
    $serviceContainer = new ServiceContainer();

    // register services
    $serviceProvider = new ServiceProvider($serviceContainer);
    $serviceProvider->register();
    $serviceProvider->boot();

    // check routes to get controller
    $route = $serviceContainer->getInstance(RouteFactory::class);
    $controller = $route->getControllerInstance($serviceContainer);

    // run controller
    $controller->index();
  }
}
