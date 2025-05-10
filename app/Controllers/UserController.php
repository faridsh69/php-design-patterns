<?php

namespace App\Controllers;

use App\Models\User;

final class UserController
{
  public User $user;
  public function __construct(User $user)
  {
    $this->user = $user;
  }
  public function index()
  {
    echo $this->user->name;
  }
}
