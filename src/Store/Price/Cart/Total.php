<?php

namespace App\Store\Price\Cart;

class Total
{
    public $preTotal;
    public $finalTotal;

    public function __construct(PreTotal $preTotal, FinalTotal $finalTotal)
    {
        $this->preTotal = $preTotal;
        $this->finalTotal = $finalTotal;
    }
}
