<?php

namespace App\Services\Printer;

class LegacyPrinter
{
  public function printMessage(string $message)
  {
    echo strtolower($message);
  }
}
