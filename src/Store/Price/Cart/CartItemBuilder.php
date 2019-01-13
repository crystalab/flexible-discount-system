<?php

namespace App\Store\Price\Cart;

use App\Store\Product\Product;
use App\Store\Product\Unit;

class CartItemBuilder
{
    private $product;
    private $amount;
    private $totalPrice;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): CartItemBuilder
    {
        $this->product = new Product("Product", 0, new Unit("Unit", false));
        $this->amount = 0;
        $this->totalPrice = 0;
        return $this;
    }

    public function withProduct(Product $product): CartItemBuilder
    {
        $this->product = $product;
        return $this;
    }

    public function withAmount(float $amount): CartItemBuilder
    {
        $this->amount = $amount;
        return $this;
    }

    public function withTotalPrice(float $totalPrice): CartItemBuilder
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function build(): CartItem
    {
        return new CartItem(
            $this->product,
            $this->amount,
            $this->totalPrice
        );
    }
}
