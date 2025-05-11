<?php

namespace App\Laravel;

use App\Laravel\Db\Concretes\Db;
use App\Laravel\Db\Contracts\DbContract;
use App\Laravel\ServiceContainer;
use App\Services\Order\Concretes\OrderBuilder;
use App\Services\Order\Contracts\OrderBuilderContract;
use App\Services\User\Concretes\UserService;
use App\Services\User\Contracts\UserServiceContract;

final class ServiceProvider
{
  public ServiceContainer $serviceContainer;

  public function __construct(ServiceContainer $serviceContainer)
  {
    $this->serviceContainer = $serviceContainer;
  }

  public function register()
  {
    echo '#2 Service provider: implementing DI inside service container <br />';
    $this->serviceContainer->setInstance(DbContract::class, Db::class, true);
    $this->serviceContainer->setInstance(UserServiceContract::class, UserService::class);
    $this->serviceContainer->setInstance(OrderBuilderContract::class, OrderBuilder::class);
  }
}
