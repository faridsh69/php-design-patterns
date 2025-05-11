<?php

namespace App\Services\Payment\Contracts;

interface PaymentContract
{
  public function pay(): string;
}
