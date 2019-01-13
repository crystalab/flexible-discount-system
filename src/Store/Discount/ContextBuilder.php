<?php

namespace App\Store\Discount;

use App\Store\Price\Cart\Cart;
use App\Store\Price\Cart\Total;

class ContextBuilder
{
    private $rules;
    private $productIdToGroupsMap;
    private $cart;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): ContextBuilder
    {
        $this->rules = [];
        $this->productIdToGroupsMap = [];
        $this->cart = new Cart(new Total([], 0), [], new Total([], 0));
        return $this;
    }

    public function withProductIdToGroupsMap(array $productIdToGroupsMap): ContextBuilder
    {
        $this->productIdToGroupsMap = $productIdToGroupsMap;
        return $this;
    }

    public function withCart(Cart $cart): ContextBuilder
    {
        $this->cart = $cart;
        return $this;
    }

    public function build(): Context
    {
        return new Context(
            $this->rules,
            $this->productIdToGroupsMap,
            $this->cart
        );
    }
}
