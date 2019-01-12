<?php

namespace App\Store\Discount\Rule;

class AllMatchRule extends AbstractCompoundRule
{
    public function match(Context $context): bool
    {
        foreach ($this->getInnerRules() as $innerRule) {
            if (!$innerRule->match($context)) {
                return false;
            }
        }

        return true;
    }
}
