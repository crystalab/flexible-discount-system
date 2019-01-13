<?php

namespace App\Store\Product;

class ProductBuilder
{
    private $id;
    private $name;
    private $price;
    private $unit;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): ProductBuilder
    {
        $this->id = 1;
        $this->name = "Product";
        $this->price = 0;
        $this->unit = new Unit("Unit", false);
        return $this;
    }

    public function withId(int $id): ProductBuilder
    {
        $this->id = $id;
        return $this;
    }

    public function build(): Product
    {
        $instance = new Product($this->name, $this->price, $this->unit);

        $property = (new \ReflectionClass(Product::class))->getProperty("id");
        $property->setAccessible(true);
        $property->setValue($instance, $this->id);
        $property->setAccessible(false);

        return $instance;
    }
}
