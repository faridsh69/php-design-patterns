<?php

namespace App\Services\Payment\Concretes;

use App\Services\Payment\Contracts\PaymentContract;

class PaymentPaypal implements PaymentContract
{
  public function pay(): string
  {
    return "Paypal";
  }
}
