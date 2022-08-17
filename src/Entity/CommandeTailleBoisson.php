<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeTailleBoissonRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandeTailleBoissonRepository::class)]
#[ApiResource()]

class CommandeTailleBoisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(['com','comr'])]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['com','comr'])]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandeTailleBoissons')]
    private $commande;

    #[Groups(['com'])]
    #[ORM\ManyToOne(targetEntity: TailleBoisson::class, inversedBy: 'commandeTailleBoissons', cascade:["persist"])]
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
