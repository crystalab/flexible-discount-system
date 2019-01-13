<?php

namespace App\Store\Discount\Benefit;

use App\Store\Discount\Context;
use App\Store\Price\Cart\CartItem;
use App\Store\Product\Product;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class FreeProductBenefit extends AbstractBenefit
{
    /**
     * @ORM\OneToOne(targetEntity="App\Store\Product\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /** @ORM\Column(type="float") */
    private $amount;

    public function __construct(Product $product, float $amount)
    {
        $this->product = $product;
        $this->amount = $amount;
    }

    public function applyTimes(Context $context, int $times): void
    {
        foreach ($context->cart->finalTotal->items as $item) {
            if ($item->product->getId() === $this->product->getId()) {
                $item->amount += $this->amount * $times;
                return;
            }
        }

        $context->cart->finalTotal->items[] = new CartItem($this->product, $this->amount, 0);
    }
}
