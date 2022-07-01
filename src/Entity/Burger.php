<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Produit;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
    collectionOperations:["get",
    "post" => [
        "method"=>"post",
        // "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        // "security_message"=>"uniquement reserver aux gestionnaires",
        "denormalization_context"=>['group'=>["write"]],
        'normalization_context' => ['groups' => ['burger']]

       ]],
    itemOperations:["put","get"]
    
      
    
    )]
class Burger extends Produit
{
 #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'burgers')]
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
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        $this->menus->removeElement($menu);

        return $this;
    }
}
