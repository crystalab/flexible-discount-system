<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;
use App\Store\Price\Cart\CalculatedItem;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class TotalCountOfProductsRule extends AbstractCountableRule
{
    protected function extractCountFromContext(Context $context): float
    {
        return array_reduce($context->preTotal->items, function ($carry, CalculatedItem $item) {
            return $carry + $item->amount;
        }, 0);
    }
}
