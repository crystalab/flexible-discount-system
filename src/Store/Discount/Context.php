<?php

namespace App\Store\Discount;

use App\Store\Discount\Rule\AbstractRule;
use App\Store\Price\Cart\Cart;
use App\Store\Product\ProductGroup;

class Context
{
    /** @var AbstractRule[] */
    public $rules;
    /** @var ProductGroup[][] */
    public $productIdToGroupsMap;
    public $cart;

    public function __construct(array $rules, array $productIdToGroupsMap, Cart $cart)
    {
        $this->rules = $rules;
        $this->productIdToGroupsMap = $productIdToGroupsMap;
        $this->cart = $cart;
    }
}
