<?php

namespace App\Events;

class UserLogginedEvent
{
  public $username;

  public function __construct($username)
  {
    $this->username = $username;
  }
}
