<?php

namespace App\Store\Discount\Rule;

class AllMatchRuleTest extends AbstractCompoundRuleTest
{
    /** @var AllMatchRule */
    private $instance;

    protected function setUp()
    {
        parent::setUp();
        $this->instance = new AllMatchRule();
    }

    /** @test */
    public function matchTimesShouldReturnZeroWhenNoInnerRulesProvided()
    {
        $actual = $this->instance->matchTimes($this->getContextBuilder()->build());

        $this->assertSame(0, $actual);
    }

    /** @test */
    public function matchTimesShouldReturnMinNestedMatchingValue()
    {
        $this->instance->getInnerRules()->add($this->createSimpleRuleMock(1));
        $this->instance->getInnerRules()->add($this->createSimpleRuleMock(2));

        $actual = $this->instance->matchTimes($this->getContextBuilder()->build());

        $this->assertSame(1, $actual);
    }

    /** @test */
    public function matchTimesShouldBreaksOnFirstRuleWithZeroResponse()
    {
        $this->instance->getInnerRules()->add($this->createSimpleRuleMock(0));
        $this->instance->getInnerRules()->add($this->createSimpleRuleMock());

        $actual = $this->instance->matchTimes($this->getContextBuilder()->build());

        $this->assertSame(0, $actual);
    }
}
