<?php

namespace App\Store\Discount\Benefit;

use App\Store\Discount\Context;
use App\Store\Price\Cart\Total;
use App\Store\Product\Product;

class FreeProductBenefitTest extends AbstractBenefitTest
{
    /** @var AbsoluteDiscountBenefit */
    private $instance;
    /** @var Total */
    private $finalTotal;
    /** @var Context */
    private $context;
    /** @var Product */
    private $product;

    protected function setUp()
    {
        parent::setUp();
        $this->product = $this->getProductBuilder()->build();
        $this->instance = new FreeProductBenefit($this->product, 2);
        $this->finalTotal = $this->getTotalBuilder()->build();
        $this->context = $this->getContextBuilder()->withCart(
            $this->getCartBuilder()->withFinalTotal($this->finalTotal)->build()
        )->build();
    }

    /** @test */
    public function applyTimesShouldAddNewFreeProductIfItsNotExists()
    {
        $this->instance->applyTimes($this->context, 1);

        $this->assertCount(1, $this->finalTotal->items);
        $this->assertEqualsWithDelta(2, $this->finalTotal->items[0]->amount, 0.01);
        $this->assertEqualsWithDelta(0, $this->finalTotal->items[0]->totalPrice, 0.01);
        $this->assertSame($this->product, $this->finalTotal->items[0]->product);
    }

    /** @test */
    public function applyTimesShouldIncreaseAmountOfExistingProduct()
    {
        $this->finalTotal->items[] = $this->getCartItemBuilder()
            ->withProduct($this->product)
            ->withAmount(5)
            ->withTotalPrice(10.0)
            ->build();

        $this->instance->applyTimes($this->context, 1);

        $this->assertCount(1, $this->finalTotal->items);
        $this->assertEqualsWithDelta(7, $this->finalTotal->items[0]->amount, 0.01);
    }
}
