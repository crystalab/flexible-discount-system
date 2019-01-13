<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;
use App\Store\Price\Cart\CartItem;
use App\Store\Product\ProductGroup;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class CountOfProductsOfGroupRule extends AbstractCountableRule
{
    /**
     * @ORM\OneToOne(targetEntity="App\Store\Product\ProductGroup")
     * @ORM\JoinColumn(name="product_group_id", referencedColumnName="id")
     */
    private $productGroup;

    public function __construct(string $operator, float $count, ProductGroup $productGroup)
    {
        parent::__construct($operator, $count);
        $this->productGroup = $productGroup;
    }

    protected function extractCountFromContext(Context $context): float
    {
        return array_reduce($context->cart->preTotal->items, function (int $carry, CartItem $item) use ($context) {
            if (!empty($context->productIdToGroupsMap[$item->product->getId()])) {
                /** @var ProductGroup $productGroup */
                foreach ($context->productIdToGroupsMap[$item->product->getId()] as $productGroup) {
                    if ($productGroup->getId() === $this->productGroup->getId()) {
                        return $carry + $item->amount;
                    }
                }
            }

            return $carry;
        }, 0);
    }
}
