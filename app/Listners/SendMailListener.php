<?php

namespace App\Listners;

use App\Laravel\EventListner\EventListenerInterface;

class SendMailListener implements EventListenerInterface
{
  public function handle($event)
  {
    echo "mail {$event->username}...\n";
  }
}
