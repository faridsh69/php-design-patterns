<?php

namespace App\Controllers;

use App\Laravel\Db\Contracts\DbContract;
use App\Services\Order\Contracts\OrderBuilderContract;
use App\Services\Order\Decorators\DiscountOrderDecorator;
use App\Services\User\Contracts\UserServiceContract;

final class UserController
{
  public DbContract $db;
  public OrderBuilderContract $order;
  public UserServiceContract $userService;

  public function __construct(DbContract $db, OrderBuilderContract $order, UserServiceContract $userService)
  {
    $this->db = $db;
    $this->order = $order;
    $this->userService = $userService;
  }

  public function index()
  {
    echo '#5 MVC: design pattern MVC to controll logic with controller <br />';
    echo '#6 Service layer: design pattern service layer to separate logic from controller<br />';
    return $this->userService->index();

    $this->order->setProducts(['name' => 'farid']);
    $this->order->setAddress('this is my address');
    $this->order->setPayment('Visacard');
    $this->order->getPrice(); // 100

    $order = new DiscountOrderDecorator($this->order, 10);
    $order->getPrice(); // 90
  }
}
