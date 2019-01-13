<?php

namespace App\Store\Price;

use App\Store\Discount\Context;
use App\Store\Discount\DiscountRepo;
use App\Store\Discount\Rule\RuleRepo;
use App\Store\Product\ProductGroupRepo;

class Calculator
{
    private $discountRepo;
    private $ruleRepo;
    /**
     * @var \App\Store\Product\ProductGroupRepo
     */
    private $productGroupRepo;

    public function __construct(DiscountRepo $discountRepo, RuleRepo $ruleRepo, ProductGroupRepo $productGroupRepo)
    {
        $this->discountRepo = $discountRepo;
        $this->ruleRepo = $ruleRepo;
        $this->productGroupRepo = $productGroupRepo;
    }

    /** @param Cart\Item[] $items */
    public function calculateTotal(array $items): Cart\Cart
    {
        $cart = $this->createCart($items);

        $rules = $this->ruleRepo->findAll();
        $discounts = $this->discountRepo->findAll();

        $context = new Context(
            $this->productGroupRepo->getProductIdToGroupsMap($this->getProductIds($items)),
            $cart
        );

        foreach ($discounts as $discount) {
            $times = $discount->getRootRule()->matchTimes($context);

            if ($times <= 0) {
                continue;
            }

            if (!$discount->isMultipliable()) {
                $times = 1;
            }

            foreach ($discount->getBenefits() as $benefit) {
                $benefit->applyTimes($context, $times);
            }
        }

        return $cart;
    }

    private function getProductIds(array $items): array
    {
        return array_map(function (Cart\Item $item) {
            return $item->product->getId();
        }, $items);
    }

    private function createCart(array $items): Cart\Cart
    {
        $preTotal = $this->calculateCartTotal($items);
        $finalTotal = $this->calculateCartTotal($items);
        return new Cart\Cart($preTotal, [], $finalTotal);
    }

    /** @param Cart\Item[] $items */
    private function calculateCartTotal(array $items): Cart\Total
    {
        $total = 0;
        $cartItems = [];

        foreach ($items as $item) {
            $sum = $item->product->getPrice() * $item->amount;
            $cartItems[] = new Cart\CartItem(
                $item->product,
                $item->amount,
                $sum
            );
            $total += $sum;
        }

        return new Cart\Total(
            $cartItems,
            $total
        );
    }
}
