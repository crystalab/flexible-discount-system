<?php

namespace App\Store\Product;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity(repositoryClass="App\Store\Product\ProductGroupRepo") */
class ProductGroup
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /** @ORM\Column(type="string", length=255) */
    private $name;

    /**
     * @var ArrayCollection|Product[]
     * @ORM\ManyToMany(targetEntity="App\Store\Product\Product")
     * @ORM\JoinTable(
     *     name="group_product",
     *     joinColumns={@ORM\JoinColumn(name="product_group_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     * )
     */
    private $products;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->products = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /** @return ArrayCollection|Product[] */
    public function getProducts()
    {
        return $this->products;
    }
}
