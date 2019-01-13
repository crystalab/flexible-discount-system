<?php

namespace App\Store\Price\Cart;

class Cart
{
    public $preTotal;
    /** @var DiscountItem[] */
    public $discounts;
    public $finalTotal;

    public function __construct(Total $preTotal, array $discounts, Total $finalTotal)
    {
        $this->preTotal = $preTotal;
        $this->discounts = $discounts;
        $this->finalTotal = $finalTotal;
    }
}
