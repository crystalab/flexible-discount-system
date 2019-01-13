<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;

abstract class AbstractCountableRuleTest extends AbstractRuleTest
{
    abstract public function contextProvider(): array;

    /** @test @dataProvider contextProvider */
    public function matchTimesShouldReturnExpectedValue(
        Context $context,
        AbstractCountableRule $rule,
        int $expectedValue
    ) {
        $actualValue = $rule->matchTimes($context);

        $this->assertSame($expectedValue, $actualValue);
    }
}
