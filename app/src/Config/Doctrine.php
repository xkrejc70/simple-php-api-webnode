<?php

namespace App\Config;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

return function () {
    $config = ORMSetup::createAnnotationMetadataConfiguration(
        [__DIR__ . '/../Entity'],
        true, // dev mode
    );

    $connection = [
        'dbname' => $_ENV['DB_DATABASE'],
        'user' => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PASSWORD'],
        'host' => $_ENV['DB_HOST'],
        'driver' => 'pdo_mysql',
    ];

    return EntityManager::create($connection, $config);
};
