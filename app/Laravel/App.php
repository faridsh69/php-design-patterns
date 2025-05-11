<?php

namespace App\Laravel;

final class App
{
  public static function run()
  {
    echo '#1 Dependency injection: using service container <br />';
    $serviceContainer = new ServiceContainer();

    echo '#2 Service provider: injecting dependencies to service container with service provider <br />';
    $serviceProvider = new ServiceProvider($serviceContainer);
    $serviceProvider->register();

    echo '#3 Factory: for creating controllers based on routes <br />';
    $routeFactory = $serviceContainer->getInstance(RouteFactory::class);
    $controller = $routeFactory->getControllerInstance($serviceContainer);

    echo '#4 MVC: design pattern MVC to controll logic layer with controller, get data from model, pass to view <br />';
    return $controller->index();
  }
}
