<?php

use App\Config\Database;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Dotenv\Dotenv;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// DI
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    EntityManager::class => require __DIR__ . '/../src/Config/Doctrine.php',
    OrderRepository::class => function ($c) {
        return new OrderRepository($c->get(EntityManager::class));
    },
    OrderController::class => function ($c) {
        return new OrderController($c->get(OrderRepository::class));
    },
]);
$container = $containerBuilder->build();
AppFactory::setContainer($container);

// App
$app = AppFactory::create();
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Routes
(require __DIR__ . '/../src/Routes/Api.php')($app);

$app->run();
