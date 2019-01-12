<?php

namespace App\Store\Product;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity(repositoryClass="App\Store\Product\ProductRepo") */
class Product
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /** @ORM\Column(type="string", length=255) */
    private $name;

    /** @ORM\Column(type="float") */
    private $price;

    /**
     * @var Unit
     * @ORM\ManyToOne(targetEntity="App\Store\Product\Unit", fetch="EAGER", cascade={})
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     */
    private $unit;

    public function __construct(string $name, float $price, Unit $unit)
    {
        $this->name = $name;
        $this->price = $price;
        $this->unit = $unit;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }
}
