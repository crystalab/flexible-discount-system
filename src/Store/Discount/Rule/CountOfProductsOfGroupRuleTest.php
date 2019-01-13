<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;
use App\Store\Price\Cart\CalculatedItem;
use App\Store\Price\Cart\PreTotal;
use App\Store\Product\Product;

class CountOfProductsOfGroupRuleTest extends AbstractCountableRuleTest
{
    public function contextProvider(): array
    {
        $productGroupWithIdOne = $this->getProductGroupBuilder()->withId(1)->build();

        $productWithIdOne = $this->getProductBuilder()->withId(1)->build();
        $productWithIdTwo = $this->getProductBuilder()->withId(2)->build();

        $eqZeroRule = new CountOfProductsOfGroupRule(AbstractCountableRule::OPERATOR_EQ, 0, $productGroupWithIdOne);
        $gteOneRule = new CountOfProductsOfGroupRule(AbstractCountableRule::OPERATOR_GTE, 1, $productGroupWithIdOne);
        $ltTwoRule = new CountOfProductsOfGroupRule(AbstractCountableRule::OPERATOR_LT, 2, $productGroupWithIdOne);

        $zeroItemsContext = $this->getContextBuilder()
            ->withProductIdToGroupsMap([
                1 => [$productGroupWithIdOne]
            ])
            ->withPreTotal(
                $this->getPreTotalBuilder()->withItems([
                    $this->getCalculatedItemBuilder()->withAmount(1)->withProduct($productWithIdTwo)->build()
                ])->build()
            )
            ->build();
        $oneItemContext = $this->getContextBuilder()
            ->withProductIdToGroupsMap([
                1 => [$productGroupWithIdOne]
            ])
            ->withPreTotal(
                $this->getPreTotalBuilder()->withItems([
                    $this->getCalculatedItemBuilder()->withAmount(1)->withProduct($productWithIdOne)->build(),
                    $this->getCalculatedItemBuilder()->withAmount(1)->withProduct($productWithIdTwo)->build()
                ])->build()
            )
            ->build();
        $fiveItemContext = $this->getContextBuilder()
            ->withProductIdToGroupsMap([
                1 => [$productGroupWithIdOne],
                2 => [$productGroupWithIdOne],
            ])
            ->withPreTotal(
                $this->getPreTotalBuilder()->withItems([
                    $this->getCalculatedItemBuilder()->withAmount(4)->withProduct($productWithIdOne)->build(),
                    $this->getCalculatedItemBuilder()->withAmount(1)->withProduct($productWithIdTwo)->build()
                ])->build()
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
