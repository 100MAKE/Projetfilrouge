<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuBurgerRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\SerializedName;


#[ORM\Entity(repositoryClass: MenuBurgerRepository::class)]
#[ApiResource()]
class MenuBurger
{
    #[Groups("details")]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    

    #[SerializedName("quantiteStock")]
    #[Groups(["details"])]
    #[Assert\NotBlank(message: 'la quantité ne peut etre null')]
    #[ORM\Column(type: 'integer')]
    private $quantite;

    #[Groups("details")]
    #[ORM\ManyToOne(targetEntity: Burger::class, inversedBy: 'menuBurgers', cascade: ["persist"])]
    private $burger;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuBurgers', cascade: ["persist"])]
    private $menu;

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

    public function getBurger(): ?Burger
    {
        return $this->burger;
    }

    public function setBurger(?Burger $burger): self
    {
        $this->burger = $burger;

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
}
