<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;
use App\Store\Price\Cart\CartItem;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class TotalCountOfProductsRule extends AbstractCountableRule
{
    protected function extractCountFromContext(Context $context): float
    {
        return array_reduce($context->cart->preTotal->items, function ($carry, CartItem $item) {
            return $carry + $item->amount;
        }, 0);
    }
}
