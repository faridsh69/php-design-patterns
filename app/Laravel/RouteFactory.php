<?php

namespace App\Laravel;

use App\Controllers\ProductController;
use App\Controllers\UserController;
use Exception;

class RouteFactory
{
  // We should extract it to out of laravel folder scope
  public static $routes = [
    'user' => UserController::class,
    'product' => ProductController::class,
  ];

  public function getControllerInstance(ServiceContainer $serviceContainer)
  {
    $url = isset($_GET['route']) ? $_GET['route'] : 'user';

    if (!isset(self::$routes[$url])) {
      throw new Exception('Route not found');
    }

    $controller = self::$routes[$url];
    return $serviceContainer->getInstance($controller);
  }
}
