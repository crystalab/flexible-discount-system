<?php

namespace App\Store\Price\Cart;

class TotalBuilder
{
    private $items;
    private $total;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): TotalBuilder
    {
        $this->items = [];
        $this->total = 0;
        return $this;
    }

    public function withItems(array $items): TotalBuilder
    {
        $this->items = $items;
        return $this;
    }

    public function withTotal(float $total): TotalBuilder
    {
        $this->total = $total;
        return $this;
    }

    public function build(): Total
    {
        return new Total(
            $this->items,
            $this->total
        );
    }
}
