<?php

namespace App\Store\Discount\Benefit;

use App\Store\Discount\Context;
use App\Store\Discount\Discount;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="benefit")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discount_type", type="string")
 */
abstract class AbstractBenefit
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /**
     * @var Discount
     * @ORM\ManyToOne(targetEntity="App\Store\Discount\Discount", inversedBy="benefits")
     * @ORM\JoinColumn(name="discount_id", referencedColumnName="id")
     */
    private $discount;

    abstract public function applyTimes(Context $context, int $times): void;

    public function getId(): int
    {
        return $this->id;
    }
}
