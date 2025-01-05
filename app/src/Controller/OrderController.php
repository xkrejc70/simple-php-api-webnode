<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Routes\JsonResponseFormatter;
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
            $responseData = JsonResponseFormatter::error('Order not found', 404);
            $response->getBody()->write(json_encode($responseData));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $responseData = JsonResponseFormatter::success($order->toArray());
        $response->getBody()->write(json_encode($responseData));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
