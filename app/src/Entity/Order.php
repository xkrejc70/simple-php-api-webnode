<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`order`")
 */
class Order {
    /**
     * @ORM\Id
     * @ORM\Column(type="string", unique=true)
     */
    public string $id;

    /** @ORM\Column(type="datetime", name="creation_date") */
    public \DateTime $creationDate;

    /** @ORM\Column(type="string") */
    public string $name;

    /** @ORM\Column(type="float") */
    public float $amount;

    /** @ORM\Column(type="string") */
    public string $currency;

    /** @ORM\Column(type="string") */
    public string $status;

    /**
     * @ORM\OneToMany(targetEntity="OrderItem", mappedBy="order", cascade={"persist", "remove"}, fetch="EAGER")
     */
    public Collection $items;

    public function __construct() {
        $this->items = new ArrayCollection();
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'creationDate' => $this->creationDate->format('Y-m-d H:i:s'),
            'name' => $this->name,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'status' => $this->status,
            'items' => $this->items->map(fn(OrderItem $item) => $item->toArray())->toArray(),
        ];
    }
}
