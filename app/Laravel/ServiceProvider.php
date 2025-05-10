<?php

namespace App\Laravel;

use App\Controllers\UserController;
use App\Laravel\ServiceContainer;
use App\Services\Db\Contracts\DbContract;
use App\Services\Db\Concretes\DbConcrete;
use App\Services\Order\Concretes\OrderConcrete;
use App\Services\Order\Contracts\OrderContract;

// #4 design pattern Service provider
final class ServiceProvider
{
  public ServiceContainer $app;

  public function __construct(ServiceContainer $app)
  {
    $this->app = $app;
  }

  public function register()
  {
    $this->app->setInstance(DbContract::class, DbConcrete::class, true);
    $this->app->setInstance(OrderContract::class, OrderConcrete::class);
    $this->app->setInstance(UserController::class, UserController::class);
  }

  public function boot() {}
}
