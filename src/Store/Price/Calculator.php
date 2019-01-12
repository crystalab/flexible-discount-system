<?php

namespace App\Store\Price;

class Calculator
{
    public function __construct()
    {
    }

    /**
     * @param Cart\Item[] $items
     * @return Cart\Total
     */
    public function calculateTotal(array $items): Cart\Total
    {
        $calculatedItems = [];

        foreach ($items as $item) {
            $calculatedItems[] = new Cart\CalculatedItem(
                $item->product,
                $item->amount,
                $item->product->getPrice() * $item->amount
            );
        }

        return new Cart\Total($calculatedItems, $calculatedItems);
    }
}
