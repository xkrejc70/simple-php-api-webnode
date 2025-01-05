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
     * @ORM\Column(type="string")
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
     * @ORM\OneToMany(targetEntity="OrderItem", mappedBy="order", cascade={"persist", "remove"})
     */
    public Collection $items;

    public function __construct() {
        $this->items = new ArrayCollection();
    }
}
