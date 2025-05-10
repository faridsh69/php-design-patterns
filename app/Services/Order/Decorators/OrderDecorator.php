<?php

namespace App\Services\Order\Decorators;

use App\Services\Order\Abstracts\OrderAbstract;
use App\Services\Order\Contracts\OrderContract;

class OrderDecorator extends OrderAbstract implements OrderContract
{
  protected $order;

  public function __construct(OrderContract $order)
  {
    $this->order = $order;
  }

  public function getPrice(): float
  {
    return $this->order->getPrice();
  }
}
