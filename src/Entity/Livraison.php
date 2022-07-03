<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $montantLivraison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantLivraison(): ?int
    {
        return $this->montantLivraison;
    }

    public function setMontantLivraison(int $montantLivraison): self
    {
        $this->montantLivraison = $montantLivraison;

        return $this;
    }
}
