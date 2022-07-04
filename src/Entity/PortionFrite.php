<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PortionFriteRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PortionFriteRepository::class)]
#[ApiResource(
    collectionOperations:["get",
    "post"=>[
"method"=>"post",
// "security"=>"is_granted('ROLE_GESTIONNAIRE')",
// "security_message"=>"uniquement reserver aux gestionnaires",
'denormalization_context'=>['groups'=>['portion:read:simple']]

    ]
],
    itemOperations:["put","get"]
    )]
class PortionFrite extends Produit
{     
    //  #[Groups(["menus"])]
     #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'portionfrites')]
    private $menus;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->addPortionfrite($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removePortionfrite($this);
        }

        return $this;
    }
}
