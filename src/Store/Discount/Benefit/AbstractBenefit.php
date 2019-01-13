<?php

namespace App\Store\Discount\Benefit;

use App\Store\Discount\Context;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discount_type", type="string")
 */
abstract class AbstractBenefit
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    abstract public function applyTimes(Context $context, int $times): void;

    public function getId(): int
    {
        return $this->id;
    }
}
