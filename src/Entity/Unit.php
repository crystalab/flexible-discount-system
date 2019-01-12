<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity(repositoryClass="App\Repository\UnitRepo") */
class Unit
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /** @ORM\Column(type="string", length=255) */
    private $name;

    /** @ORM\Column(type="boolean") */
    private $isPartible;

    public function __construct(string $name, bool $isPartible)
    {
        $this->name = $name;
        $this->isPartible = $isPartible;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isPartible(): bool
    {
        return $this->isPartible;
    }
}
