<?php

namespace App\Store\Price\Cart;

class PreTotal
{
    /** @var CalculatedItem[] */
    public $items;
    public $total;

    public function __construct(array $items, float $total)
    {
        $this->items = $items;
        $this->total = $total;
    }
}
