<?php

namespace App\Store\Price\Cart;

use App\Store\Product\Product;
use App\Store\Product\Unit;

class CartBuilder
{
    private $preTotal;
    private $discounts;
    private $finalTotal;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): CartBuilder
    {
        $this->preTotal = new Total([], 0);
        $this->discounts = [];
        $this->finalTotal = new Total([], 0);
        return $this;
    }

    public function withPreTotal(Total $total): CartBuilder
    {
        $this->preTotal = $total;
        return $this;
    }

    public function withDiscounts(array $discounts): CartBuilder
    {
        $this->discounts = $discounts;
        return $this;
    }

    public function withFinalTotal(Total $total): CartBuilder
    {
        $this->finalTotal = $total;
        return $this;
    }

    public function build(): Cart
    {
        return new Cart(
            $this->preTotal,
            $this->discounts,
            $this->finalTotal
        );
    }
}
