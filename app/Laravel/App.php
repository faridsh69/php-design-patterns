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

    // check routes to get controller
    $routeFactory = $serviceContainer->getInstance(RouteFactory::class);
    $controller = $routeFactory->getControllerInstance($serviceContainer);

    // run controller
    $controller->index();
  }
}
