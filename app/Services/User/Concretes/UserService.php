<?php

namespace App\Services\User\Concretes;

use App\Repositories\UserRepository;
use App\Resources\UserResource;
use App\Services\User\Contracts\UserServiceContract;

class UserService implements UserServiceContract
{
  private UserRepository $userRepository;
  private UserResource $userResource;

  public function __construct(UserRepository $userRepository, UserResource $userResource)
  {
    $this->userRepository = $userRepository;
    $this->userResource = $userResource;
  }

  public function index()
  {
    echo '#7 Repository pattern: design pattern Repository to separate DB layer from data logic<br />';
    $users = $this->userRepository->all();

    echo '#8 Resource pattern: design pattern Resource to have a layer for formatting data<br />';
    return $this->userResource->toArray($users);
  }
}
