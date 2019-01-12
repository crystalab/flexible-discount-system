<?php

namespace App\Store\Price\Cart;

use App\Store\Product\Product;

class Item
{
    public $product;
    public $amount;

    public function __construct(Product $product, float $amount)
    {
        $this->product = $product;
        $this->amount = $amount;
    }
}
