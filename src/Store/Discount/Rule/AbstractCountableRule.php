<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
abstract class AbstractCountableRule extends AbstractSimpleRule
{
    const OPERATOR_EQ  = "==";
    const OPERATOR_LT  = "<";
    const OPERATOR_GTE = ">=";

    /** @ORM\Column(type="string", length=3) */
    private $operator;

    /** @ORM\Column(type="float") */
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

    public function matchTimes(Context $context): int
    {
        $count = $this->extractCountFromContext($context);
        switch ($this->operator) {
            case self::OPERATOR_EQ:
                return $count === $this->count ? 1 : 0;
                break;
            case self::OPERATOR_LT:
                return $count < $this->count ? 1 : 0;
            case self::OPERATOR_GTE:
                return floor($count / $this->count);
            default:
                throw new Exception\UnexpectedValueException("Unsupported operator value provided");
        }
    }

    abstract protected function extractCountFromContext(Context $context): float;
}
