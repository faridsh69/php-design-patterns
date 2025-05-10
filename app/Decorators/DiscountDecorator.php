<?php

namespace App\Decorators;

use App\Services\Order\Concretes\OrderBuilder;
use App\Services\Order\Decorators\OrderDecorator;

// #6 design pattern Decorator
final class DiscountDecorator extends OrderDecorator
{
  protected float $discount = 10;

  public function getPrice(): float
  {
    return parent::getPrice() - $this->discount;
  }
}
