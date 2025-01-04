<?php

use App\Repository\OrderRepository;
use PHPUnit\Framework\TestCase;

class OrderRepositoryTest extends TestCase {

    private OrderRepository $orderRepo;

    protected function setUp(): void {
        $this->orderRepo = new OrderRepository();
        // TODO: load test data from .sql file
    }

    public function testFindById(): void {
        $order = $this->orderRepo->findById('1');
        $this->assertNotNull($order);
        $this->assertEquals('1', $order->id);
    }

    public function testFindByIdNonexistentOrder(): void {
        $order = $this->orderRepo->findById('nonexistent-id');
        $this->assertNull($order);
    }
}
