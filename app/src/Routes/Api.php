<?php

use App\Controller\OrderController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {

    // Get Order by id
    $app->get('/order/{id}', [OrderController::class, 'getOrderById']);

};
