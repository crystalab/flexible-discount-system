<?php

namespace App\Store\Price\Cart;

class PreTotalBuilder
{
    private $items;
    private $total;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): PreTotalBuilder
    {
        $this->items = [];
        $this->total = 0;
        return $this;
    }

    public function withItems(array $items): PreTotalBuilder
    {
        $this->items = $items;
        return $this;
    }

    public function withTotal(float $total): PreTotalBuilder
    {
        $this->total = $total;
        return $this;
    }

    public function build(): PreTotal
    {
        return new PreTotal(
            $this->items,
            $this->total
        );
    }
}
