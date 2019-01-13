<?php

namespace App\Store\Discount;

use App\Store\Discount\Rule\AbstractRule;
use App\Store\Price\Cart\PreTotal;
use App\Store\Product\ProductGroup;

class Context
{
    /** @var AbstractRule[] */
    public $rules;
    /** @var ProductGroup[][] */
    public $productIdToGroupsMap;
    public $preTotal;

    public function __construct(array $rules, array $productIdToGroupsMap, PreTotal $preTotal)
    {
        $this->rules = $rules;
        $this->productIdToGroupsMap = $productIdToGroupsMap;
        $this->preTotal = $preTotal;
    }
}
