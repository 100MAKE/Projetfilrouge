<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeMenuRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandeMenuRepository::class)]
class CommandeMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['com:details:all', 'com:details'])]
    #[ORM\Column(type: 'integer')]
    private $quantite;


    #[ORM\Column(type: 'integer',nullable: true)]
    private $prix;

    #[Groups(['com:details:all', 'com:details'])]
    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'commandeMenus')]
    private $menu;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandeMenus')]
    private $commande;

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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

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
}
