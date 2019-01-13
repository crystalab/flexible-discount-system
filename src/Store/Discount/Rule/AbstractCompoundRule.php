<?php

namespace App\Store\Discount\Rule;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
abstract class AbstractCompoundRule extends AbstractRule
{
    /**
     * @var AbstractRule[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Store\Discount\Rule\AbstractRule")
     * @ORM\JoinTable(
     *     name="inner_rule",
     *     joinColumns={@ORM\JoinColumn(name="child_rule_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="parent_rule_id", referencedColumnName="id")}
     * )
     */
    private $innerRules;

    public function __construct()
    {
        $this->innerRules = new ArrayCollection();
    }

    /** @return AbstractRule[]|ArrayCollection */
    public function getInnerRules()
    {
        return $this->innerRules;
    }
}
