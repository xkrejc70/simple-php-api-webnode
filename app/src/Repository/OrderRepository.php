<?php

namespace App\Repository;

use App\Config\Database;
use App\Entity\Order;
use App\Entity\OrderItem;
use PDO;

class OrderRepository {
    
    public function findById(string $id): ?Order {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare('SELECT * FROM `order` WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $orderData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$orderData) {
            return null;
        }

        $order = new Order();
        $order->id = $orderData['id'];
        $order->creationDate = $orderData['creation_date'];
        $order->name = $orderData['name'];
        $order->amount = (float)$orderData['amount'];
        $order->currency = $orderData['currency'];
        $order->status = $orderData['status'];

        $stmt = $pdo->prepare('SELECT * FROM `order_items` WHERE order_id = :id');
        $stmt->execute(['id' => $id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($items as $itemData) {
            $item = new OrderItem();
            $item->name = $itemData['name'];
            $item->amount = (float)$itemData['amount'];
            $order->items[] = $item;
        }

        return $order;
    }
}
