<?php

namespace App\Entity;

use App\Entity\Burger;
use App\Entity\Commande;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeBurgerRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommandeBurgerRepository::class)]
#[ApiResource()]
class CommandeBurger
{
    // #[Groups(['com'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['com','comr'])]
    private $id;

    #[Assert\Positive]
    #[Groups(['com','comr'])]
    #[ORM\Column(type: 'integer')]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandeBurgers')]
    private $commande;

    #[Groups(['com'])]
    #[ORM\ManyToOne(targetEntity: Burger::class, inversedBy: 'commandeBurgers')]
    private $burger;
    // #[Groups(['com:details:all', 'com:details'])]

    #[ORM\Column(type: 'integer', nullable: true)]
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

    public function getBurger(): ?Burger
    {
        return $this->burger;
    }

    public function setBurger(?Burger $burger): self
    {
        $this->burger = $burger;

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
