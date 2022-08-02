<?php

namespace App\Entity;

use App\Repository\CommandeTailleBoissonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeTailleBoissonRepository::class)]
class CommandeTailleBoisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandeTailleBoissons')]
    private $commande;

    #[ORM\ManyToOne(targetEntity: TailleBoisson::class, inversedBy: 'commandeTailleBoissons')]
    private $tailleboisson;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
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

    public function getTailleboisson(): ?TailleBoisson
    {
        return $this->tailleboisson;
    }

    public function setTailleboisson(?TailleBoisson $tailleboisson): self
    {
        $this->tailleboisson = $tailleboisson;

        return $this;
    }
}
