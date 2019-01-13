<?php

namespace App\Store\Price\Cart;

use App\Store\Product\Product;

class CartItem extends Item
{
    public $totalPrice;

    public function __construct(Product $product, float $amount, float $totalPrice)
    {
        parent::__construct($product, $amount);
        $this->totalPrice = $totalPrice;
    }
}
