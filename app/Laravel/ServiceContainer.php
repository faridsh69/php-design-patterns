<?php

namespace App\Laravel;

use App\Controllers\UserController;
use ReflectionClass;

final class ServiceContainer
{
  public $contractConcretes = [];
  public $singletons = [];

  public function getInstance(string $contract)
  {
    if (isset($this->singletons[$contract])) {
      return $this->singletons[$contract];
    }

    $concrete = isset($this->contractConcretes[$contract]) ? $this->contractConcretes[$contract] : $contract;
    $instance = $this->createInstance($concrete);


    return $instance;
  }

  public function setInstance(string $contract, string $concrete)
  {
    // $instance = $this->createInstance($concrete);

    $this->contractConcretes[$contract] = $concrete;
    // $this->contractConcretes[$contract] = compact('concrete');
  }

  public function createInstance(string $concrete)
  {
    $reflection = new ReflectionClass($concrete);

    if (!$reflection->isInstantiable()) {
      throw new Exception("Class [$concrete] is not instantiable.");
    }

    $constuctor = $reflection->getConstructor();

    if (is_null($constuctor)) {
      return new $concrete();
    }
    $params = $constuctor->getParameters();
    $dependencies = [];

    foreach ($params as $param) {
      $dependencies[] = $this->getInstance($param->getType()->getName());
    }

    return $reflection->newInstanceArgs($dependencies);
  }

  public function run()
  {
    $this->setInstance(ServiceProvider::class, ServiceProvider::class);

    $serviceProvider = $this->getInstance(ServiceProvider::class);
    $serviceProvider->register();
    $serviceProvider->boot();

    $controller = $this->getInstance(UserController::class);
    $controller->index();

    // 1 routes => factory
    // 2 db => singleton
    // 3 order => builder
    // 4 Auth => facades
    // 5 logger=> decorator + pipeline
    // 6 even listener => observable
    // 7 create command line => 

    // adaptor, proxy, bridge, strategy
    // state, command, mediator

    //     $container->setInstance(DbContract::class, DbConcrete::class);
    // $container->setInstance(SampleContract::class, SampleConcrete::class);

    // $db = $container->getInstance(DbContract::class);
    // $sample = $container->getInstance(SampleContract::class);
    // $sample->init();

    // $db->connect();


    // echo " -- Log generated.\n";

  }
}
