<?php

use App\Config\Database;
use DI\ContainerBuilder;
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
    Database::class => function () {
        return new Database(
            $_ENV['DB_HOST'],
            $_ENV['DB_PORT'],
            $_ENV['DB_DATABASE'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD']
        );
    },
    OrderRepository::class => function ($c) {
        return new OrderRepository($c->get(Database::class));
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
(require __DIR__ . '/../src/Routes/api.php')($app);

$app->run();
