<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use App\HelloWorld;
use function DI\create;

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

// App
$helloWorld = $container->get(HelloWorld::class);
$helloWorld->announce();
