<?php

namespace App\Store\Discount\Rule;

abstract class AbstractCountRule extends AbstractRule
{
    const OPERATOR_EQ = "=";
    const OPERATOR_LT = "<";
    const OPERATOR_GT = ">";

    private $operator;
    private $count;

    public function __construct(string $operator, float $count)
    {
        $this->operator = $operator;
        $this->count = $count;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function getCount(): float
    {
        return $this->count;
    }
}
