<?php

namespace App\Store\Discount\Rule;

use App\Store\Product\Product;

class CountOfProductsRule extends AbstractCountRule
{
    private $product;

    public function __construct(string $operator, float $count, Product $product)
    {
        parent::__construct($operator, $count);
        $this->product = $product;
    }
}
