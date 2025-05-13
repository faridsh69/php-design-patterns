<?php

namespace App\Laravel;

use App\Laravel\Db\Concretes\Db;
use App\Laravel\Db\Contracts\DbContract;
use App\Laravel\EventListner\EventDispatcher;
use App\Laravel\ServiceContainer;
use App\Services\Order\Concretes\OrderBuilder;
use App\Services\Order\Contracts\OrderBuilderContract;
use App\Services\Payment\Concretes\PaymentCard;
use App\Services\Payment\Concretes\PaymentPaypal;
use App\Services\Payment\Contracts\PaymentContract;
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
    $this->serviceContainer->setInstance(UserServiceContract::class, UserService::class);
    $this->serviceContainer->setInstance(OrderBuilderContract::class, OrderBuilder::class);

    echo '#3 Singleton: for creating only one instance of DB to have only 1 time connecting to DB <br />';
    // Same we need singleton for config, also for event listener
    $this->serviceContainer->setInstance(Config::class, Config::class, true);
    $this->serviceContainer->setInstance(DbContract::class, Db::class, true);
    $this->serviceContainer->setInstance(EventDispatcher::class, EventDispatcher::class, true);

    // #11 Strategy pattern: this is payment strategy
    $pay = isset($_GET['pay']) ? $_GET['pay'] : 'paypal';
    if ($pay === 'paypal') {
      $this->serviceContainer->setInstance(PaymentContract::class, PaymentPaypal::class);
    } else {
      $this->serviceContainer->setInstance(PaymentContract::class, PaymentCard::class);
    }
  }
}
