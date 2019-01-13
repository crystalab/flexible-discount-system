<?php

namespace App\Store\Discount;

use App\Store\Discount\Benefit\AbstractBenefit;
use App\Store\Discount\Rule\AbstractRule;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity(repositoryClass="App\Store\Discount\DiscountRepo") */
class Discount
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /** @ORM\Column(type="string", length=255) */
    private $name;

    /** @ORM\Column(type="boolean") */
    private $isMultipliable;

    /**
     * @var AbstractRule
     * @ORM\OneToOne(targetEntity="App\Store\Discount\Rule\AbstractRule")
     * @ORM\JoinColumn(name="root_rule_id", referencedColumnName="id")
     */
    private $rootRule;

    /**
     * @var AbstractBenefit[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Store\Discount\Benefit\AbstractBenefit", mappedBy="discount", fetch="EAGER")
     */
    private $benefits;

    public function __construct(string $name, bool $isMultipliable, AbstractRule $rootRule, array $benefits)
    {
        $this->name = $name;
        $this->isMultipliable = $isMultipliable;
        $this->rootRule = $rootRule;
        $this->benefits = $benefits;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isMultipliable(): bool
    {
        return $this->isMultipliable;
    }

    public function getRootRule(): AbstractRule
    {
        return $this->rootRule;
    }

    /** @return AbstractBenefit[]|ArrayCollection */
    public function getBenefits()
    {
        return $this->benefits;
    }


}
