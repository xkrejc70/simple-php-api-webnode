<?php

namespace App\Entity;

class Order {
    public string $id;
    public string $creationDate;
    public string $name;
    public float $amount;
    public string $currency;
    public string $status;

    /** @var OrderItem[] */
    public array $items = [];
}
