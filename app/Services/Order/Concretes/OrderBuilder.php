<?php

namespace App\Services\Order\Concretes;

use App\Services\Order\Abstracts\OrderAbstract;
use App\Services\Order\Contracts\OrderBuilderContract;

class OrderBuilder extends OrderAbstract implements OrderBuilderContract
{
  public function getPrice(): float
  {
    return count($this->products) * 100;
  }
}
