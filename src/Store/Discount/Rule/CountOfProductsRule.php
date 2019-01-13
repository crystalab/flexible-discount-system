<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;
use App\Store\Product\Product;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class CountOfProductsRule extends AbstractCountableRule
{
    /**
     * @ORM\OneToOne(targetEntity="App\Store\Product\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    public function __construct(string $operator, float $count, Product $product)
    {
        parent::__construct($operator, $count);
        $this->product = $product;
    }

    protected function extractCountFromContext(Context $context): float
    {
        foreach ($context->preTotal->items as $item) {
            if ($item->product->getId() === $this->product->getId()) {
                return $item->amount;
            }
        }

        return 0;
    }
}
