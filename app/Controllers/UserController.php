<?php

namespace App\Controllers;

use App\Decorators\DiscountDecorator;
use App\Laravel\Db\Concretes\DbConcrete;
use App\Laravel\Db\Contracts\DbContract;
use App\Services\Order\Contracts\OrderContract;

final class UserController
{
  public DbConcrete $db;
  public OrderContract $order;

  public function __construct(DbContract $db, OrderContract $order)
  {
    $this->db = $db;
    $this->order = $order;
  }

  public function index()
  {
    echo 'UserController <br />';
    $this->db->connect();
    $this->order->setProducts(['name' => 'farid']);
    $this->order->setAddress('this is my address');
    $this->order->setPayment('Visacard');

    $order = new DiscountDecorator($this->order, 10);
    dd($order->getPrice());
  }
}
