<?php

namespace App\Store\Discount\Benefit;

use App\Store\Discount\Context;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class PercentDiscountBenefit extends AbstractBenefit
{
    /** @ORM\Column(type="float") */
    private $discountPercents;

    public function __construct(float $discountPercents)
    {
        $this->discountPercents = $discountPercents;
    }

    public function applyTimes(Context $context, int $times): void
    {
        $discountSum = $context->cart->preTotal->total / 100 * $this->discountPercents * $times;
        $context->cart->finalTotal->total = max(0, $context->cart->finalTotal->total - $discountSum);
    }
}
