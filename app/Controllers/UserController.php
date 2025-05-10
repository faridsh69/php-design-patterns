<?php

namespace App\Controllers;

use App\Services\Db\Contracts\DbContract;
use App\Services\Order\Contracts\OrderContract;

final class UserController
{
  public DbContract $db;
  public OrderContract $orderService;

  public function __construct(DbContract $db, OrderContract $orderService)
  {
    $this->db = $db;
    $this->orderService = $orderService;
  }
  public function index()
  {
    $this->db->connect();
    $this->orderService->setProducts(['name' => 'farid']);
    $this->orderService->setAddress('this is my address');
    $this->orderService->setPayment('Visacard');
    dd($this->orderService);
  }
}
