<?php

namespace App\Services\Payment\Concretes;

use App\Services\Payment\Contracts\PaymentContract;

class PaymentCard implements PaymentContract
{
  public function pay(): string
  {
    return "Credit Card";
  }
}
