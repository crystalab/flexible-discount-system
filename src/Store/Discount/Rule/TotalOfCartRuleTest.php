<?php

namespace App\Store\Discount\Rule;

class TotalOfCartRuleTest extends AbstractCountableRuleTest
{
    public function contextProvider(): array
    {
        $eqZeroRule = new TotalOfCartRule(AbstractCountableRule::OPERATOR_EQ, 0);
        $gteOneRule = new TotalOfCartRule(AbstractCountableRule::OPERATOR_GTE, 1);
        $ltTwoRule = new TotalOfCartRule(AbstractCountableRule::OPERATOR_LT, 2);

        $zeroTotalContext = $this->getContextBuilder()
            ->withCart(
                $this->getCartBuilder()->withPreTotal(
                    $this->getTotalBuilder()->withTotal(0)->build()
                )->build()
            )
            ->build();
        $oneTotalContext = $this->getContextBuilder()
            ->withCart(
                $this->getCartBuilder()->withPreTotal(
                    $this->getTotalBuilder()->withTotal(1)->build()
                )->build()
            )
            ->build();
        $fiveTotalContext = $this->getContextBuilder()
            ->withCart(
                $this->getCartBuilder()->withPreTotal(
                    $this->getTotalBuilder()->withTotal(5)->build()
                )->build()
            )
            ->build();

        return [
            'positive: 0 eq 0 = 1'  => [$zeroTotalContext, $eqZeroRule, 1],
            'negative: 1 eq 0 = 0'  => [$oneTotalContext,  $eqZeroRule, 0],
            'positive: 0 lt 1 = 1'  => [$zeroTotalContext, $ltTwoRule,  1],
            'negative: 2 lt 2 = 0'  => [$fiveTotalContext, $ltTwoRule,  0],
            'positive: 1 gte 1 = 1' => [$oneTotalContext,  $gteOneRule, 1],
            'positive: 5 gte 1 = 5' => [$fiveTotalContext, $gteOneRule, 5],
        ];
    }
}
