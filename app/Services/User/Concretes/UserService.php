<?php

namespace App\Services\User\Concretes;

use App\Events\UserLogginedEvent;
use App\Facades\CacheFacade;
use App\Laravel\EventListner\EventDispatcher;
use App\Proxies\ViewUserProfileProxy;
use App\Repositories\UserRepository;
use App\Resources\UserResource;
use App\Services\Message\ErrorMessage;
use App\Services\Message\MailSender;
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

    echo '#8 Resource pattern: managing data of a specific type to be in one shape<br /><br />';
    $response = $this->userResource->toArray($users);

    $this->makeOrderWithBuilder();
    $this->addDiscountWithDecorator();
    $this->doPaymentWithStrategy();
    $this->sendNotificationWithEventListner();
    $this->cacheUsersWithFacade($users);
    $this->authorizationUsingProxy();
    $this->sendErrorMailUsingBridge();

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

  private function addDiscountWithDecorator()
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

    echo ($result) . '<br><br>';
  }

  private function sendNotificationWithEventListner()
  {
    echo '#12 Observer pattern: When  object changes state, all its dependents are notified and updated automatically<br>
    for example here we will send notification when order is paid => result <br />';

    $userLogginedEvent = new UserLogginedEvent('farid');
    $this->eventDispatcher->dispatch($userLogginedEvent);
  }

  private function cacheUsersWithFacade($users)
  {
    echo '<br /><br /> #13 Facade pattern: for simplifying complex interactions with a set of classes<br>
    for example here we will cache all users => result <br />';

    CacheFacade::remember('users', 60, $users);
  }

  private function authorizationUsingProxy()
  {
    echo '<br /><br /> #14 Proxy pattern: for providing a surrogate or placeholder for another object to control access to it<br>
    for example here we will check authorization => result <br />';

    $userProfile = new ViewUserProfileProxy();
    $userProfile->getProfile();
  }

  private function sendErrorMailUsingBridge()
  {
    echo '<br /><br /> #15 Bridge pattern: when we have for example 3 type of pitza, margarita, pepperoni and cheese,
    and we have 3 cheff: italian, persian and american cheff, then we should not have 9 classes,
    we can have 3 classes cat1, 3 classes type2 and 1 abstract class bridge<br>
    for example here we will send error mail => result <br />';

    $mailSender = new MailSender();
    $mailErrorMessage = new ErrorMessage($mailSender);
    $mailErrorMessage->send('text');
  }
}
