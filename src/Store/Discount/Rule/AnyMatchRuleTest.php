<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;
use App\Store\Price\Cart\PreTotal;

class AnyMatchRuleTest extends AbstractCompoundRuleTest
{
    /** @var AnyMatchRule */
    private $instance;

    protected function setUp()
    {
        parent::setUp();
        $this->instance = new AnyMatchRule();
    }

    /** @test */
    public function matchTimesShouldReturnOneWhenNoInnerRulesProvided()
    {
        $actual = $this->instance->matchTimes(new Context([], [], new PreTotal([], 0)));

        $this->assertSame(1, $actual);
    }

    /** @test */
    public function matchTimesShouldReturnMaxNestedMatchingValue()
    {
        $this->instance->getInnerRules()->add($this->createSimpleRuleMock(0));
        $this->instance->getInnerRules()->add($this->createSimpleRuleMock(2));

        $actual = $this->instance->matchTimes(new Context([], [], new PreTotal([], 0)));

        $this->assertSame(2, $actual);
    }
}
