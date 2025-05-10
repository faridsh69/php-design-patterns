<?php

namespace App\Laravel;

use App\Controllers\UserController;
use App\Laravel\ServiceContainer;

final class ServiceProvider
{
  public ServiceContainer $app;

  public function __construct(ServiceContainer $app)
  {
    $this->app = $app;
  }

  public function register()
  {
    $this->app->setInstance(UserController::class, UserController::class);
  }

  public function boot() {}
}
