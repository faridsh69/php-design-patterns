++ A Creational Patterns
++ 1) singleton: ensures a class has only one instance and provides a global point of access to it.
for creating only one instance of DB to have only 1 time connecting to DB
++ 2) prototype: Creating a new instance is expensive, so clone an existing instance
clone: $clone = $userModel->replicate(); $clone->push(); // Save new user
    ++ 3) Factory: provides a method for creating objects without specifying the exact classname,but with type
    	for creating controllers based on routes
    ++ 4) Builder: used to construct complex objects step by step
    	$order->setProduct(), $order->setPrice, ... instead of new Order($products, $price, ...)

- B structural
  ++ 10) bridge
  ++ 11) adaptor
  ++ 12) facades => https://laravel.com/docs/12.x/facades
  ++ 13) proxy -> controls access: auth gaurd
  ++ 14) decorator, pipeline: for adding additional behavior to an object dynamically
  without altering their structure, we can override method, with parrent::methodname

++ C Behavioural
++ 20) strategy => Switch between different properties classes at runtime.
for example we are checking the url param to pay by creditcard or paypal
++ 21) observable => event listner
When object changes state, all its dependents are notified and updated automatically
++ 22) command => php artisan - dispatching Jobs, for bus Queue
turns a request into a stand-alone object that contains all the information about the request.
++ 23) state => removing if, else, switch and use mostly classes for different behaviors
++ 24) mediator => even listener, jobs, objects communicate via a central mediator object
promotes loose coupling by preventing objects from referring to each other explicitly

++ D architurue
++ 30) MVC: model view controller
inside controller we need to write business, in model only data, on view present
++ 31) Service Layer: for encapsulates business logic from controller and repository
inside controller only call service and resource
++ 32) Repository: separates the data access layer (model) from the business logic layer (service)
dont add anything to your model related data flow, use repository
++ 33) Resource: Managing data of a model to be in one shape
return data only through resources

****************\*\***************** SOLID ****************\*\*****************

S Single Responsibility: should have only one job or responsibility, EASY

O Open/Closed: should be open for extension but closed for modification, EASY

L Liskov Substitution: a parent-class should be replaceable with its sub-class without breaking app, EASY
class UserRepository extends RepositoryAbstract
class AdminRepository extends RepositoryAbstract
we can substitute UserRepository anywhere a BaseRepository is expected, nothing will break

I Interface Segregation: keeping contracts focused and minimal, several small, interfaces than a large, EASY
There is a RepositoryContract with only 3 relevant methods: all, find and create
There is no RepositoryContract with 20+ methods that all consumers must implement

D Dependency Inversion: High-level modules should not depend on low-level modules, both depend on abstractions
Controller => depends on RepositoryContract
Repository => depends on RepositoryContract
we can change database in repo without change controller, because doesn't rely on each other

****************\*\***************** PRACTICAL RESULT ****************\*\*****************
1 Inside Controller use Service + Resource
2 Inside Service use Repository
3 Factory: which class to new => factory: if (1) new class1 if (2) new class2
4 Strategy: which property as class => strategy: if (1) $x->pay = new cls1 if (2) $x->pay = new cls2
5 Builder: which property values => builder setX: $x->x = 1; setY: $x->y = 2
6 Observer: which job todo => event listner: event(new UserRegistered($user));
7 Singletone: need keep memory for instance return self::$instance
8 Decorator: override method => decoration $user->getPrice = parent::getPrice - discount
9 Proxy: override method, check access, do cache, do log
10 Facade: get ride of container::getInstance and simple usage of class
11 bridge
12 adaptor
