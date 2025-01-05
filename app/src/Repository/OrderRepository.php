<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\ORM\EntityManager;

class OrderRepository {

    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    public function findById(string $id): ?Order {
        return $this->entityManager->find(Order::class, $id);
    }

}
