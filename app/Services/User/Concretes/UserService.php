<?php

namespace App\Services\User\Concretes;

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

  public function __construct(
    UserRepository $userRepository,
    UserResource $userResource,
    OrderBuilderContract $orderBuilder,
    PaymentProcessor $paymentProcessorStrategy
  ) {
    $this->userRepository = $userRepository;
    $this->userResource = $userResource;
    $this->orderBuilder = $orderBuilder;
    $this->paymentProcessorStrategy = $paymentProcessorStrategy;
  }

  public function index()
  {
    echo '#7 Repository pattern: separates the data access layer (model) from the business logic layer (service)<br />';
    $users = $this->userRepository->all();

    echo '#8 Resource pattern: managing data of a specific type to be in one shape<br />';

    $this->getOrderAndPayment();

    return $this->userResource->toArray($users);
  }

  public function getOrderAndPayment()
  {
    $this->orderBuilder->setProducts(['name' => 'farid']);
    $this->orderBuilder->setAddress('this is my address');
    $this->orderBuilder->setPayment('Visacard');
    $this->orderBuilder->getPrice(); // 100
    $order = new DiscountOrderDecorator($this->orderBuilder, 10);
    echo ' #9 Decorator pattern: for adding additional behavior to an  object dynamically<br>
    for example here we add discount to order class => result ';
    echo $order->getPrice() . '<br>'; // 90

    $result = $this->paymentProcessorStrategy->checkout(90);
    echo '#10 Strategy pattern: for defining strategy of payment to inject proper class in service provider<br>
    for example here we are checking the url param to pay by credit card or paypal => result ';
    echo ($result);
  }
}
