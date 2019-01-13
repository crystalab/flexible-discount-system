<?php

namespace App\Store;

use App\Store\Discount\ContextBuilder;
use App\Store\Price\Cart\CartBuilder;
use App\Store\Price\Cart\CartItemBuilder;
use App\Store\Price\Cart\TotalBuilder;
use App\Store\Product\ProductBuilder;
use App\Store\Product\ProductGroupBuilder;
use PHPUnit\Framework\TestCase;

abstract class AbstractStoreTest extends TestCase
{
    /** @var ContextBuilder */
    private $contextBuilder;

    /** @var CartBuilder */
    private $cartBuilder;

    /** @var TotalBuilder */
    private $totalBuilder;

    /** @var CartItemBuilder */
    private $cartItemBuilder;

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

    public function getCartBuilder(): CartBuilder
    {
        if ($this->cartBuilder === null) {
            $this->cartBuilder = new CartBuilder();
        }

        return $this->cartBuilder;
    }

    public function getTotalBuilder(): TotalBuilder
    {
        if ($this->totalBuilder === null) {
            $this->totalBuilder = new TotalBuilder();
        }

        return $this->totalBuilder;
    }

    public function getCartItemBuilder(): CartItemBuilder
    {
        if ($this->cartItemBuilder === null) {
            $this->cartItemBuilder = new CartItemBuilder();
        }

        return $this->cartItemBuilder;
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
