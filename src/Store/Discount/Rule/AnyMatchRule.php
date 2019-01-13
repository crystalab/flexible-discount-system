<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;

class AnyMatchRule extends AbstractCompoundRule
{
    public function matchTimes(Context $context): int
    {
        if ($this->getInnerRules()->isEmpty()) {
            return 1;
        }

        $results = [];

        foreach ($this->getInnerRules() as $innerRule) {
            $results[] = $innerRule->matchTimes($context);
        }

        return max($results);
    }
}
