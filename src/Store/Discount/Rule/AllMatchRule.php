<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;

class AllMatchRule extends AbstractCompoundRule
{
    public function matchTimes(Context $context): int
    {
        if ($this->getInnerRules()->isEmpty()) {
            return 0;
        }

        $results = [];
        foreach ($this->getInnerRules() as $innerRule) {
            $result = $innerRule->matchTimes($context);
            if ($result === 0) {
                return 0;
            }

            $results[] = $result;
        }

        return min($results);
    }
}
