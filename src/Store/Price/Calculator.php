<?php

namespace App\Store\Price;

class Calculator
{
    public function __construct()
    {
    }

    public function calculateTotal(array $products): Total
    {
        return new Total();
    }
}
