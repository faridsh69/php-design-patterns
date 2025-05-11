<?php

namespace App\Services\Order\Decorators;

use App\Services\Order\Abstracts\OrderAbstract;
use App\Services\Order\Contracts\OrderBuilderContract;

class OrderDecorator extends OrderAbstract implements OrderBuilderContract
{
  protected $order;

  public function __construct(OrderBuilderContract $order)
  {
    $this->order = $order;
  }

  public function getPrice(): float
  {
    return $this->order->getPrice();
  }
}
