<?php

namespace App\Services\Order\Contracts;

interface OrderContract
{
  public function setProducts($products);
  public function setAddress($address);
  public function setPayment($payment);
  public function getPrice(): float;
}
