<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PortionFriteRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: PortionFriteRepository::class)]
#[ApiResource(
    collectionOperations:["get","post"],
    itemOperations:["put","get"]
    
      
    
    )]
class PortionFrite extends Produit
{
    // #[ORM\ManyToOne(targetEntity: Complements::class, inversedBy: 'portionfrites')]
    // private $complements;

    // public function getComplements(): ?Complements
    // {
    //     return $this->complements;
    // }

    // public function setComplements(?Complements $complements): self
    // {
    //     $this->complements = $complements;

    //     return $this;
    // }
}
