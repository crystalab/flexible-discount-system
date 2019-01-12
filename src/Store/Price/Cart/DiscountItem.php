<?php

namespace App\Store\Price\Cart;

class DiscountItem
{
    public $name;
    public $amount;

    public function __construct(string $name, float $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }
}
