<?php

namespace App\Controllers;

use App\Decorators\DiscountDecorator;
use App\Laravel\Db\Contracts\DbContract;
use App\Services\Order\Contracts\OrderContract;

final class UserController
{
  public DbContract $db;
  public OrderContract $OrderBuilder;

  public function __construct(DbContract $db, OrderContract $OrderBuilder)
  {
    $this->db = $db;
    $this->OrderBuilder = $OrderBuilder;
  }

  public function index()
  {
    echo 'UserController <br />';
    $this->db->connect();
    $this->OrderBuilder->setProducts(['name' => 'farid']);
    $this->OrderBuilder->setAddress('this is my address');
    $this->OrderBuilder->setPayment('Visacard');
    $order = new DiscountDecorator($this->OrderBuilder, 10);
    dd($order->getPrice());
  }
}
