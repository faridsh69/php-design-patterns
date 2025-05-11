<?php

namespace App\Services\Payment\Concretes;

use App\Services\Payment\Contracts\PaymentContract;

class PaymentProcessor
{
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
