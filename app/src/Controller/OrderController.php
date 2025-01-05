<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class OrderController {
    
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function getOrderById(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
        $order = $this->orderRepository->findById($id);

        if (!$order) {
            $response->getBody()->write(json_encode(['error' => 'Order not found']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $response->getBody()->write(json_encode($order->toArray()));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
