<?php

namespace App\Laravel;

use Exception;
use ReflectionClass;

// #1 design pattern Dependency injection 
final class ServiceContainer
{
  private $contractConcretes = [];
  // #2 design pattern Singleton 
  private $singletonInstances = [];

  public function setInstance(string $contract, string $concrete, bool $isSingleton = false)
  {
    if (!$isSingleton) {
      $this->contractConcretes[$contract] = $concrete;
      return;
    }

    $this->singletonInstances[$contract] = $this->createInstance($concrete);
  }

  public function getInstance(string $contract)
  {
    if (isset($this->singletonInstances[$contract])) {
      return $this->singletonInstances[$contract];
    }

    if (isset($this->contractConcretes[$contract])) {
      $concrete = $this->contractConcretes[$contract];
    } else {
      $concrete = $contract;
    }

    return $this->createInstance($concrete);
  }

  private function createInstance(string $concrete)
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
}
