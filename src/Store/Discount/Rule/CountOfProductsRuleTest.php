<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;
use App\Store\Price\Cart\CalculatedItem;
use App\Store\Price\Cart\PreTotal;
use App\Store\Product\Product;

class CountOfProductsRuleTest extends AbstractCountableRuleTest
{
    public function contextProvider(): array
    {
        $productWithIdOne = $this->getProductBuilder()->withId(1)->build();
        $productWithIdTwo = $this->getProductBuilder()->withId(2)->build();

        $eqZeroRule = new CountOfProductsRule(AbstractCountableRule::OPERATOR_EQ, 0, $productWithIdOne);
        $gteOneRule = new CountOfProductsRule(AbstractCountableRule::OPERATOR_GTE, 1, $productWithIdOne);
        $ltTwoRule = new CountOfProductsRule(AbstractCountableRule::OPERATOR_LT, 2, $productWithIdOne);

        $zeroItemsContext = $this->getContextBuilder()
            ->withPreTotal(
                $this->getPreTotalBuilder()->withItems([
                    $this->getCalculatedItemBuilder()->withAmount(1)->withProduct($productWithIdTwo)->build()
                ])->build()
            )
            ->build();
        $oneItemContext = $this->getContextBuilder()
            ->withPreTotal(
                $this->getPreTotalBuilder()->withItems([
                    $this->getCalculatedItemBuilder()->withAmount(1)->withProduct($productWithIdOne)->build(),
                    $this->getCalculatedItemBuilder()->withAmount(1)->withProduct($productWithIdTwo)->build()
                ])->build()
            )
            ->build();
        $fiveItemContext = $this->getContextBuilder()
            ->withPreTotal(
                $this->getPreTotalBuilder()->withItems([
                    $this->getCalculatedItemBuilder()->withAmount(5)->withProduct($productWithIdOne)->build(),
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
