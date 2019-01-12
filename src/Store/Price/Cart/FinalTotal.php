<?php

namespace App\Store\Price\Cart;

class FinalTotal
{
    /** @var CalculatedItem[] */
    public $items;
    /** @var DiscountItem[] */
    public $discounts;
    public $total;

    public function __construct(array $items, array $discounts, float $total)
    {
        $this->items = $items;
        $this->discounts = $discounts;
        $this->total = $total;
    }
}
