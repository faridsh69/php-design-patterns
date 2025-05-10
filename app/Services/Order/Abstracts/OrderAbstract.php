<?php

namespace App\Services\Order\Abstracts;

use App\Services\Order\Contracts\OrderContract;

abstract class OrderAbstract implements OrderContract
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
