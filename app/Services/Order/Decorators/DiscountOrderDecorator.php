<?php

namespace App\Services\Order\Decorators;

use App\Services\Order\Decorators\OrderDecorator;

// #6 design pattern Decorator
final class DiscountOrderDecorator extends OrderDecorator
{
  protected float $discount = 10;

  public function getPrice(): float
  {
    return parent::getPrice() - $this->discount;
  }
}
