<?php

namespace App\Services\User\Concretes;

use App\Events\UserLogginedEvent;
use App\Laravel\EventListner\EventDispatcher;
use App\Repositories\UserRepository;
use App\Resources\UserResource;
use App\Services\Order\Contracts\OrderBuilderContract;
use App\Services\Order\Decorators\DiscountOrderDecorator;
use App\Services\Payment\Concretes\PaymentProcessor;
use App\Services\User\Contracts\UserServiceContract;

class UserService implements UserServiceContract
{
  private UserRepository $userRepository;
  private UserResource $userResource;
  private OrderBuilderContract $orderBuilder;
  private PaymentProcessor $paymentProcessorStrategy;
  private EventDispatcher $eventDispatcher;

  public function __construct(
    UserRepository $userRepository,
    UserResource $userResource,
    OrderBuilderContract $orderBuilder,
    PaymentProcessor $paymentProcessorStrategy,
    EventDispatcher $eventDispatcher
  ) {
    $this->userRepository = $userRepository;
    $this->userResource = $userResource;
    $this->orderBuilder = $orderBuilder;
    $this->paymentProcessorStrategy = $paymentProcessorStrategy;
    $this->eventDispatcher = $eventDispatcher;
  }

  public function index()
  {
    echo '#7 Repository pattern: separates the data access layer (model) from the business logic layer (service)<br />';
    $users = $this->userRepository->all();

    echo '#8 Resource pattern: managing data of a specific type to be in one shape<br />';
    $response = $this->userResource->toArray($users);

    $this->makeOrderWithBuilder();
    $this->addDiscountUsingDecorator();
    $this->doPaymentWithStrategy();
    $this->sendNotificationWithEventListner();

    return $response;
  }

  public function makeOrderWithBuilder()
  {
    echo '#9 Builder pattern: used to construct complex objects step by step<br>
    for example here we are filling order step by step => price: ';
    $this->orderBuilder->setProducts(['name' => 'farid']);
    $this->orderBuilder->setAddress('this is my address');
    $this->orderBuilder->setPayment('Visacard');

    echo $this->orderBuilder->getPrice() . '<br>'; // 100
  }

  private function addDiscountUsingDecorator()
  {
    echo ' #10 Decorator pattern: for adding additional behavior to an  object dynamically<br>
    for example here we add discount to order class => with discount ';
    $order = new DiscountOrderDecorator($this->orderBuilder, 10);

    echo $order->getPrice() . '<br>'; // 90
  }

  private function doPaymentWithStrategy()
  {
    echo '#11 Strategy pattern: for defining strategy of payment to inject proper class in service provider<br>
    for example here we are checking the url param to pay by credit card or paypal => result ';
    $result = $this->paymentProcessorStrategy->checkout(90);

    echo ($result) . '<br>';
  }

  private function sendNotificationWithEventListner()
  {
    echo '#12 Observer pattern: When  object changes state, all its dependents are notified and updated automatically<br>
    for example here we will send notification when order is paid => result <br />';

    $userLogginedEvent = new UserLogginedEvent('farid');
    $this->eventDispatcher->dispatch($userLogginedEvent);
  }
}
