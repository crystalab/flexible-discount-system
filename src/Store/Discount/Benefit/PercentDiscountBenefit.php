<?php

namespace App\Store\Discount\Benefit;

use App\Store\Discount\Context;

class AbsoluteDiscountBenefit extends AbstractBenefit
{
    private $discountSum;

    public function __construct(float $discountSum)
    {
        $this->discountSum = $discountSum;
    }

    public function applyTimes(Context $context, int $times): void
    {

    }
}
