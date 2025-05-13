<?php

namespace App\Laravel;

use Exception;

abstract class Facade
{
  protected static function getFacadeAccessor()
  {
    throw new Exception("Facade does not implement getFacadeAccessor.");
  }

  public static function __callStatic($methodName, $args)
  {
    $serviceContainer = ServiceContainer::getServiceContainerInstance();
    $cacheInstance = $serviceContainer->getInstance(static::getFacadeAccessor());

    return $cacheInstance->$methodName(...$args);
  }
}
