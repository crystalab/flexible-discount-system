<?php

namespace App\Store\Price\Cart;

use App\Store\Product\Product;
use App\Store\Product\Unit;

class CalculatedItemBuilder
{
    private $product;
    private $amount;
    private $totalPrice;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): CalculatedItemBuilder
    {
        $this->product = new Product("Product", 0, new Unit("Unit", false));
        $this->amount = 0;
        $this->totalPrice = 0;
        return $this;
    }

    public function withProduct(Product $product): CalculatedItemBuilder
    {
        $this->product = $product;
        return $this;
    }

    public function withAmount(float $amount): CalculatedItemBuilder
    {
        $this->amount = $amount;
        return $this;
    }

    public function withTotalPrice(float $totalPrice): CalculatedItemBuilder
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function build(): CalculatedItem
    {
        return new CalculatedItem(
            $this->product,
            $this->amount,
            $this->totalPrice
        );
    }
}
