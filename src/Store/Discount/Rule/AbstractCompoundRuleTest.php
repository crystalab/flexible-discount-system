<?php

namespace App\Store\Discount\Rule;

abstract class AbstractCompoundRuleTest extends AbstractRuleTest
{
    protected function createSimpleRuleMock(int $matchingResult = null)
    {
        $mock = $this->createMock(AbstractSimpleRule::class);

        if ($matchingResult === null) {
            $mock->expects($this->never())->method("matchTimes");
        } else {
            $mock->expects($this->once())->method("matchTimes")->willReturn($matchingResult);
        }
        return $mock;
    }
}
