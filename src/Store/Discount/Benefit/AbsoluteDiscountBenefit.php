<?php

namespace App\Store\Discount\Benefit;

use App\Store\Discount\Context;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class AbsoluteDiscountBenefit extends AbstractBenefit
{
    /** @ORM\Column(type="float") */
    private $discountSum;

    public function __construct(float $discountSum)
    {
        $this->discountSum = $discountSum;
    }

    public function applyTimes(Context $context, int $times): void
    {
        $discountSum = $this->discountSum * $times;
        $context->cart->finalTotal->total = max(0, $context->cart->finalTotal->total - $discountSum);
    }
}
