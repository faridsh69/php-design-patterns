<?php

namespace App\Services\Printer;

interface ModernPrinter
{
  public function modernPrint(string $text);
}

class PrinterAdapter implements ModernPrinter
{
  private $legacyPrinter;

  public function __construct(LegacyPrinter $legacyPrinter)
  {
    $this->legacyPrinter = $legacyPrinter;
  }

  public function modernPrint(string $text)
  {
    $this->legacyPrinter->printMessage(strtoupper($text));
  }
}
