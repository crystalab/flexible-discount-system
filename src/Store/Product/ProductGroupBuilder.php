<?php

namespace App\Store\Product;

class ProductGroupBuilder
{
    private $id;
    private $name;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): ProductGroupBuilder
    {
        $this->id = 1;
        $this->name = "ProductGroup";
        return $this;
    }

    public function withId(int $id): ProductGroupBuilder
    {
        $this->id = $id;
        return $this;
    }

    public function build(): ProductGroup
    {
        $instance = new ProductGroup($this->name);

        $property = (new \ReflectionClass(ProductGroup::class))->getProperty("id");
        $property->setAccessible(true);
        $property->setValue($instance, $this->id);
        $property->setAccessible(false);

        return $instance;
    }
}
