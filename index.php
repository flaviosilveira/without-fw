<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use App\HelloWorld;
use FastRoute\RouteCollector;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Relay\Relay;
use Zend\Diactoros\ServerRequestFactory;
use function DI\create;
use function FastRoute\simpleDispatcher;

// Autoload
require_once './vendor/autoload.php';

// DI-Container
$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions([
    HelloWorld::class => create(HelloWorld::class)
]);
$container = $containerBuilder->build();

// Middleware / Routes
$routes = simpleDispatcher(function (RouteCollector $r) {
    $r->get('/hello', HelloWorld::class);
});

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler();

$requestHandler = new Relay($middlewareQueue);
$requestHandler->handle(ServerRequestFactory::fromGlobals());

// App
//$helloWorld = $container->get(HelloWorld::class);
//$helloWorld->announce();
