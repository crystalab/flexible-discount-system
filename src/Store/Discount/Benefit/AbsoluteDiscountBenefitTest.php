<?php

namespace App\Store\Discount\Benefit;

use App\Store\Discount\Context;
use App\Store\Price\Cart\Total;

class AbsoluteDiscountBenefitTest extends AbstractBenefitTest
{
    /** @var AbsoluteDiscountBenefit */
    private $instance;
    /** @var Total */
    private $finalTotal;
    /** @var Context */
    private $context;

    protected function setUp()
    {
        parent::setUp();
        $this->instance = new AbsoluteDiscountBenefit(10);
        $this->finalTotal = $this->getTotalBuilder()->withTotal(100)->build();
        $this->context = $this->getContextBuilder()->withCart(
            $this->getCartBuilder()->withFinalTotal($this->finalTotal)->build()
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
        $this->finalTotal->total = 4;

        $this->instance->applyTimes($this->context, 1);

        $this->assertEqualsWithDelta(0, $this->finalTotal->total, 0.01);
    }
}
