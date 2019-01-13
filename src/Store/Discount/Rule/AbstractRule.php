<?php

namespace App\Store\Discount\Rule;

use App\Store\Discount\Context;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Store\Discount\Rule\RuleRepo")
* @ORM\Table(name="rule")
* @ORM\InheritanceType("JOINED")
* @ORM\DiscriminatorColumn(name="rule_type", type="string")
*/
abstract class AbstractRule
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    public function getId(): string
    {
        return $this->id;
    }

    abstract public function matchTimes(Context $context): int;
}
