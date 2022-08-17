<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeTailleRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandeTailleRepository::class)]
#[ApiResource()]

class CommandeTaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'integer')]
    private $quantite;
    
    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'commandeTailles')]
    private $taille;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandeTailles')]
    private $commande;

    #[ORM\Column(type: 'integer',nullable: true)]
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getTaille(): ?Taille
    {
        return $this->taille;
    }

    public function setTaille(?Taille $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
