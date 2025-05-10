<?php

namespace App\Services\Order\Concretes;

use App\Services\Order\Contracts\OrderContract;

// #3 design pattern Builder
class OrderConcrete implements OrderContract
{
  protected $products;
  protected $address;
  protected $payment;

  public function setProducts($products)
  {
    $this->products = $products;
  }

  public function setAddress($address)
  {
    $this->address = $address;
  }

  public function setPayment($payment)
  {
    $this->payment = $payment;
  }
}
