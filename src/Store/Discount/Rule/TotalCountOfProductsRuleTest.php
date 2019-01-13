<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;
use App\Store\Price\Cart\CartItem;
use App\Store\Price\Cart\Total;
use App\Store\Product\Product;

class TotalCountOfProductsRuleTest extends AbstractCountableRuleTest
{
    public function contextProvider(): array
    {
        $eqZeroRule = new TotalCountOfProductsRule(AbstractCountableRule::OPERATOR_EQ, 0);
        $gteOneRule = new TotalCountOfProductsRule(AbstractCountableRule::OPERATOR_GTE, 1);
        $ltTwoRule = new TotalCountOfProductsRule(AbstractCountableRule::OPERATOR_LT, 2);

        $zeroItemsContext = $this->getContextBuilder()
            ->withCart(
                $this->getCartBuilder()->withPreTotal(
                    $this->getTotalBuilder()->withItems([])->build()
                )->build()
            )
            ->build();
        $oneItemContext = $this->getContextBuilder()
            ->withCart(
                $this->getCartBuilder()->withPreTotal(
                    $this->getTotalBuilder()->withItems([
                        $this->getCartItemBuilder()->withAmount(1)->build()
                    ])->build()
                )->build()
            )
            ->build();
        $fiveItemContext = $this->getContextBuilder()
            ->withCart(
                $this->getCartBuilder()->withPreTotal(
                    $this->getTotalBuilder()->withItems([
                        $this->getCartItemBuilder()->withAmount(2)->build(),
                        $this->getCartItemBuilder()->withAmount(3)->build()
                    ])->build()
                )->build()
            )
            ->build();

        return [
            'positive: 0 eq 0 = 1'  => [$zeroItemsContext, $eqZeroRule, 1],
            'negative: 1 eq 0 = 0'  => [$oneItemContext,   $eqZeroRule, 0],
            'positive: 0 lt 1 = 1'  => [$zeroItemsContext, $ltTwoRule,  1],
            'negative: 2 lt 2 = 0'  => [$fiveItemContext,  $ltTwoRule,  0],
            'positive: 1 gte 1 = 1' => [$oneItemContext,   $gteOneRule, 1],
            'positive: 5 gte 1 = 5' => [$fiveItemContext,  $gteOneRule, 5],
        ];
    }
}
