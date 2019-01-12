<?php

namespace App\Store\Discount\Rule;

abstract class AbstractCompoundRule extends AbstractRule
{
    /** @var AbstractRule[] */
    private $innerRules;

    public function __construct(array $innerRules)
    {
        $this->innerRules = $innerRules;
    }

    public function getInnerRules()
    {
        return $this->innerRules;
    }
}
