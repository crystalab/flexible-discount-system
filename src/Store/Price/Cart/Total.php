<?php

namespace App\Store\Price\Cart;

class Total
{
    /** @var CalculatedItem[] */
    public $originalItems;

    public function __construct(array $originalItems)
    {
        $this->originalItems = $originalItems;
    }
}
