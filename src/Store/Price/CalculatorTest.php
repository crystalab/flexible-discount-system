<?php

namespace App\Store\Price;

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /** @var Calculator */
    private $instance;

    protected function setUp()
    {
        $this->instance = new Calculator();
    }

    /** @test */
    public function calculateShouldReturnInstanceOfTotal()
    {
        $result = $this->instance->calculateTotal([]);

        $this->assertInstanceOf(Total::class, $result);
    }
}
