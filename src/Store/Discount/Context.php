<?php

namespace App\Store\Discount;

use App\Store\Price\Cart\Cart;
use App\Store\Product\ProductGroup;

class Context
{
    /** @var ProductGroup[][] */
    public $productIdToGroupsMap;
    public $cart;

    public function __construct(array $productIdToGroupsMap, Cart $cart)
    {
        $this->productIdToGroupsMap = $productIdToGroupsMap;
        $this->cart = $cart;
    }
}
