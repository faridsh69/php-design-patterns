<?php

namespace App\Facades;

use App\Laravel\Cache;
use App\Laravel\Facade;

final class CacheFacade extends Facade
{
  public static function getFacadeAccessor()
  {
    return Cache::class;
  }
}
