<?php

namespace App\Laravel\EventListner;

use App\Events\UserLogginedEvent;
use App\Listners\SendMailListener;
use App\Listners\SendSmsListener;

class EventDispatcher
{
  private $listeners = [];

  public function listen($eventClass, EventListenerInterface $listener)
  {
    $this->listeners[$eventClass][] = $listener;
  }

  public function dispatch($event)
  {
    $eventClass = get_class($event);

    if (empty($this->listeners[$eventClass])) return;

    foreach ($this->listeners[$eventClass] as $listener) {
      $listener->handle($event);
    }
  }

  // We should extract it to out of laravel folder scope
  public function boot()
  {
    $this->listen(UserLogginedEvent::class, new SendSmsListener());
    $this->listen(UserLogginedEvent::class, new SendMailListener());
  }
}
