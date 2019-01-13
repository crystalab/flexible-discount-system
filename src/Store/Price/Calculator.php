<?php

namespace App\Store\Price;

class Calculator
{
    public function __construct()
    {
    }

    /**
     * @param Cart\Item[] $items
     * @return Cart\Cart
     */
    public function calculateTotal(array $items): Cart\Cart
    {
        $calculatedItems = [];

        foreach ($items as $item) {
            $calculatedItems[] = new Cart\CartItem(
                $item->product,
                $item->amount,
                $item->product->getPrice() * $item->amount
            );
        }

        return new Cart\Cart($calculatedItems, [], $calculatedItems);
    }
}
