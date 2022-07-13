<?php

namespace App\Entity;

use App\Repository\CommandePortionFriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandePortionFriteRepository::class)]
class CommandePortionFrite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandePortionFrites')]
    private $commande;

    #[ORM\ManyToOne(targetEntity: PortionFrite::class, inversedBy: 'commandePortionFrites')]
    private $portionfrite;

    #[ORM\Column(type: 'integer')]
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

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getPortionfrite(): ?PortionFrite
    {
        return $this->portionfrite;
    }

    public function setPortionfrite(?PortionFrite $portionfrite): self
    {
        $this->portionfrite = $portionfrite;

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
