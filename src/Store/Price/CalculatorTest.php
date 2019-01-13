<?php

namespace App\Store\Price;

use App\Store\Product\Product;
use App\Store\Product\Unit;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /** @var Calculator */
    private $instance;

    private $pieceUnit;
    private $pineappleProduct;

    private $kgUnit;
    private $tomatoProduct;

    protected function setUp()
    {
        $this->instance = new Calculator();
        
        $this->pieceUnit = new Unit("piece", false);
        $this->pineappleProduct = new Product("Pineapple", 1.30, $this->pieceUnit);

        $this->kgUnit = new Unit("kg", true);
        $this->tomatoProduct = new Product("Tomato", 1.40, $this->kgUnit);
    }

    /** @test */
    public function calculateShouldReturnInstanceOfTotal()
    {
        $result = $this->instance->calculateTotal([]);

        $this->assertInstanceOf(Cart\Cart::class, $result);
    }

    /** @test */
    public function calculateShouldReturnOriginalItemsWithCalculatedTotal()
    {
        $result = $this->instance->calculateTotal([
            new Cart\Item($this->pineappleProduct, 5),
            new Cart\Item($this->tomatoProduct, 2.5),
        ]);

        $this->assertInternalType("array", $result->originalItems);
        $this->assertCount(2, $result->originalItems);
        $this->assertSame(5 * 1.30, $result->originalItems[0]->totalPrice);
        $this->assertSame(2.5 * 1.40, $result->originalItems[1]->totalPrice);
    }

    /** @test */
    public function calculateShouldReturnFinalItemsSameAsOriginal()
    {
        $result = $this->instance->calculateTotal([
            new Cart\Item($this->pineappleProduct, 5),
            new Cart\Item($this->tomatoProduct, 2.5),
        ]);

        $this->assertInternalType("array", $result->finalItems);
        $this->assertCount(2, $result->finalItems);
        $this->assertSame($result->originalItems[0], $result->finalItems[0]);
        $this->assertSame($result->originalItems[1], $result->finalItems[1]);
    }
}
