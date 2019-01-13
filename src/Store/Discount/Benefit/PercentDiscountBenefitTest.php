<?php

namespace App\Store\Discount\Benefit;

use App\Store\Discount\Context;
use App\Store\Price\Cart\Total;
use App\Store\Product\Product;

class PercentDiscountBenefitTest extends AbstractBenefitTest
{
    /** @var PercentDiscountBenefit */
    private $instance;
    /** @var Total */
    private $finalTotal;
    /** @var Context */
    private $context;

    protected function setUp()
    {
        parent::setUp();
        $this->instance = new PercentDiscountBenefit(10);
        $this->finalTotal = $this->getTotalBuilder()->withTotal(100)->build();
        $this->context = $this->getContextBuilder()->withCart(
            $this->getCartBuilder()
                ->withFinalTotal($this->finalTotal)
                ->withPreTotal($this->getTotalBuilder()->withTotal(100)->build())
                ->build()
        )->build();
    }

    /** @test */
    public function applyTimesShouldDecreaseFinalTotal()
    {
        $this->instance->applyTimes($this->context, 1);

        $this->assertEqualsWithDelta(90, $this->finalTotal->total, 0.01);
    }

    /** @test */
    public function applyTimesShouldRespectTimesParameter()
    {
        $this->instance->applyTimes($this->context, 6);

        $this->assertEqualsWithDelta(40, $this->finalTotal->total, 0.01);
    }

    /** @test */
    public function applyTimesShouldNotMakeFinalTotalNegative()
    {
        $this->instance->applyTimes($this->context, 12);

        $this->assertEqualsWithDelta(0, $this->finalTotal->total, 0.01);
    }
}
