<?php

namespace App\Entity;

use App\Repository\MenuPortionFriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuPortionFriteRepository::class)]
class MenuPortionFrite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: PortionFrite::class, inversedBy: 'menuPortionFrites',cascade:["persist"])]
    private $portionfrite;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuPortionFrites',cascade:["persist"])]
    private $menu;

    public function getId(): ?int
    {
        return $this->id;
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
