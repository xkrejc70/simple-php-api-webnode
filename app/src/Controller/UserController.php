<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController {
    private UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public static function getThis(): string {
        return "here I am";
    }

    public function getOrderById(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
        $order = $this->userRepository->findById($id);

        if (!$order) {
            $response->getBody()->write(json_encode(['error' => 'Order not found']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $response->getBody()->write(json_encode($order));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
