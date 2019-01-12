<?php

namespace App\Store\Discount\Rule;

class AnyMatchRule extends AbstractCompoundRule
{
    public function match(Context $context): bool
    {
        foreach ($this->getInnerRules() as $innerRule) {
            if ($innerRule->match($context)) {
                return true;
            }
        }

        return false;
    }
}
