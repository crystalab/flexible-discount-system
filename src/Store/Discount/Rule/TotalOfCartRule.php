<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class TotalOfCartRule extends AbstractCountableRule
{
    protected function extractCountFromContext(Context $context): float
    {
        return $context->preTotal->total;
    }
}
