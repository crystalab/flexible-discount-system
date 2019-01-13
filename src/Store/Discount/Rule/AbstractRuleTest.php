<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\ContextBuilder;
use App\Store\Price\Cart\CalculatedItemBuilder;
use App\Store\Price\Cart\PreTotalBuilder;
use App\Store\Product\ProductBuilder;
use App\Store\Product\ProductGroupBuilder;
use PHPUnit\Framework\TestCase;

abstract class AbstractRuleTest extends TestCase
{
    /** @var ContextBuilder */
    private $contextBuilder;

    /** @var PreTotalBuilder */
    private $preTotalBuilder;

    /** @var CalculatedItemBuilder */
    private $calculatedItemBuilder;

    /** @var ProductBuilder */
    private $productBuilder;

    /** @var ProductGroupBuilder */
    private $productGroupBuilder;

    public function getContextBuilder(): ContextBuilder
    {
        if ($this->contextBuilder === null) {
            $this->contextBuilder = new ContextBuilder();
        }

        return $this->contextBuilder;
    }

    public function getPreTotalBuilder(): PreTotalBuilder
    {
        if ($this->preTotalBuilder === null) {
            $this->preTotalBuilder = new PreTotalBuilder();
        }

        return $this->preTotalBuilder;
    }

    public function getCalculatedItemBuilder(): CalculatedItemBuilder
    {
        if ($this->calculatedItemBuilder === null) {
            $this->calculatedItemBuilder = new CalculatedItemBuilder();
        }

        return $this->calculatedItemBuilder;
    }

    public function getProductBuilder(): ProductBuilder
    {
        if ($this->productBuilder === null) {
            $this->productBuilder = new ProductBuilder();
        }

        return $this->productBuilder;
    }

    public function getProductGroupBuilder(): ProductGroupBuilder
    {
        if ($this->productGroupBuilder === null) {
            $this->productGroupBuilder = new ProductGroupBuilder();
        }

        return $this->productGroupBuilder;
    }
}
