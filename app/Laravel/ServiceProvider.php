<?php

namespace App\Laravel;

use App\Laravel\Db\Concretes\DbConcrete;
use App\Laravel\Db\Contracts\DbContract;
use App\Laravel\ServiceContainer;
use App\Services\Order\Concretes\OrderBuilder;
use App\Services\Order\Contracts\OrderContract;

// #4 design pattern Service provider
final class ServiceProvider
{
  public ServiceContainer $serviceContainer;

  public function __construct(ServiceContainer $serviceContainer)
  {
    $this->serviceContainer = $serviceContainer;
  }

  public function register()
  {
    $this->serviceContainer->setInstance(DbContract::class, DbConcrete::class, true);
    $this->serviceContainer->setInstance(OrderContract::class, OrderBuilder::class);
  }

  public function boot() {}
}
