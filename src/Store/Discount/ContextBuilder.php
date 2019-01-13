<?php

namespace App\Store\Discount;

use App\Store\Price\Cart\PreTotal;

class ContextBuilder
{
    private $rules;
    private $productIdToGroupsMap;
    private $preTotal;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): ContextBuilder
    {
        $this->rules = [];
        $this->productIdToGroupsMap = [];
        $this->preTotal = new PreTotal([], 0);
        return $this;
    }

    public function withPreTotal(PreTotal $preTotal): ContextBuilder
    {
        $this->preTotal = $preTotal;
        return $this;
    }

    public function build(): Context
    {
        return new Context(
            $this->rules,
            $this->productIdToGroupsMap,
            $this->preTotal
        );
    }
}
