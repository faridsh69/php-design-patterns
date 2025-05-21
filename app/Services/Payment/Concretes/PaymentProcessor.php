<?php

namespace App\Services\Payment\Concretes;

use App\Services\Payment\Contracts\PaymentContract;

class PaymentProcessor
{
  // #11 Based on what class we are using for the payment we can change our strategy
  protected PaymentContract $payment;

  public function __construct(PaymentContract $payment)
  {
    $this->payment = $payment;
  }

  public function checkout(float $amount): string
  {
    return $this->payment->pay($amount);
  }
}
