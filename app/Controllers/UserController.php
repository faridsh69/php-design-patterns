<?php

namespace App\Controllers;

use App\Laravel\Db\Contracts\DbContract;
use App\Services\User\Contracts\UserServiceContract;

final class UserController
{
  public DbContract $db;

  public UserServiceContract $userService;

  public function __construct(DbContract $db, UserServiceContract $userService)
  {
    $this->db = $db;
    $this->userService = $userService;
  }

  public function index()
  {
    echo '#6 Service layer: for encapsulates business logic from controller and repository<br />';
    return $this->userService->index();
  }
}
