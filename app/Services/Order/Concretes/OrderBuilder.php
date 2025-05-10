<?php

namespace App\Services\Order\Concretes;

use App\Services\Order\Abstracts\OrderAbstract;
use App\Services\Order\Contracts\OrderContract;

// #3 design pattern Builder
class OrderBuilder extends OrderAbstract implements OrderContract
{
  public function getPrice(): float
  {
    return count($this->products) * 100;
  }
}
