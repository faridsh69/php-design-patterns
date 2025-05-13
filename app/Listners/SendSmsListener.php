<?php

namespace App\Listners;

use App\Laravel\EventListner\EventListenerInterface;

class SendSmsListener implements EventListenerInterface
{
  public function handle($event)
  {
    echo "sms {$event->username}...\n";
  }
}
