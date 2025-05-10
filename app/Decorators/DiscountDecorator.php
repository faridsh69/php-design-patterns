<?php

namespace App\Decorators;

use App\Services\Order\Concretes\OrderBuilder;

// #6 design pattern Decorator
final class DiscountDecorator
{
  protected OrderBuilder $order;
  protected float $discount = 0;

  public function __construct(OrderBuilder $order, float $discount)
  {
    $this->order = $order;
    $this->discount = $discount;
  }

  public function getPrice(): float
  {
    return $this->order->getPrice() - $this->discount;
  }
}
