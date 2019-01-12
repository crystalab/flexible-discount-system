<?php

namespace App\Store\Discount\Rule;

use App\Store\Product\ProductGroup;

class CountOfProductsOfGroupRule extends AbstractCountRule
{
    private $productGroup;

    public function __construct(string $operator, float $count, ProductGroup $productGroup)
    {
        parent::__construct($operator, $count);
        $this->productGroup = $productGroup;
    }
}
