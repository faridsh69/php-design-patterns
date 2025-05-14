<?php

namespace App\Services\Message;

interface Sender
{
  public function send(string $text);
}

// This is layer one of bridge
final class MailSender implements Sender
{
  public function send(string $text)
  {
    echo 'E-Mail sent: ' . $text;
  }
}

final class SmsSender implements Sender
{
  public function send(string $text)
  {
    echo 'SMS sent: ' . $text;
  }
}

abstract class MessageAbstract
{
  protected $sender;

  public function __construct($sender)
  {
    $this->sender = $sender;
  }

  abstract public function send(string $text);
}

// This is layer two of bridge
final class ErrorMessage extends MessageAbstract
{
  public function send(string $text)
  {
    $this->sender->send('[Error] ' . $text);
  }
}

final class WarningMessage extends MessageAbstract
{
  public function send(string $text)
  {
    $this->sender->send('[Warning] ' . $text);
  }
}
