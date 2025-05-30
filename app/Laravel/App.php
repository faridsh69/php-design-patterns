<?php

namespace App\Laravel;

use App\Laravel\EventListner\EventDispatcher;

final class App
{
  public static function run()
  {
    echo '#1 Dependency injection: using service container <br />';
    $serviceContainer = new ServiceContainer();
    $serviceContainer->setServiceContainerInstance($serviceContainer);

    echo '#2 Service provider: injecting dependencies to service container with service provider <br />';
    $serviceProvider = new ServiceProvider($serviceContainer);
    $serviceProvider->register();

    $eventListener = $serviceContainer->getInstance(EventDispatcher::class);
    $eventListener->boot();

    echo '#4 Factory: for creating controllers based on routes <br /><br />';
    $routeFactory = $serviceContainer->getInstance(RouteFactory::class);
    $controller = $routeFactory->getControllerInstance($serviceContainer);

    echo '#5 MVC: design pattern MVC to controll logic layer with controller, get data from model, pass to view <br />';
    return $controller->index();
  }
}
