<?php

namespace App\Store\Price\Cart;

class Total
{
    /** @var CalculatedItem[] */
    public $originalItems;

    /** @var CalculatedItem[] */
    public $finalItems;

    public function __construct(array $originalItems, array $finalItems)
    {
        $this->originalItems = $originalItems;
        $this->finalItems = $finalItems;
    }
}
