<?php

namespace App\Laravel;

use App\Controllers\ProductController;
use App\Controllers\UserController;
use Exception;

class RouteFactory
{
  public static $routes = [
    'user' => UserController::class,
    'product' => ProductController::class,
  ];

  public function getControllerInstance(ServiceContainer $serviceContainer)
  {
    $url = $_GET['route'];

    if (!isset(self::$routes[$url])) {
      throw new Exception('Route not found');
    }

    $controller = self::$routes[$url];
    return $serviceContainer->getInstance($controller);
  }
}
