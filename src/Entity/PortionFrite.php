<?php

namespace App\Entity;

use App\Repository\PortionFriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortionFriteRepository::class)]
class PortionFrite extends Produit
{
    #[ORM\ManyToOne(targetEntity: Complements::class, inversedBy: 'portionfrites')]
    private $complements;

    public function getComplements(): ?Complements
    {
        return $this->complements;
    }

    public function setComplements(?Complements $complements): self
    {
        $this->complements = $complements;

        return $this;
    }
}
