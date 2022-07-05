<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
// #[ORM\InheritanceType("JOINED")]
// #[ApiResource(
//     collectionOperations:["get",
//     "post" => [
//     "method"=>"post",
//     // "security"=>"is_granted('ROLE_GESTIONNAIRE')",
//     // "security_message"=>"uniquement reserver aux gestionnaires",
//     // "denormalization_context"=>['group'=>["menu"]]

//        ]],
//     itemOperations:["put","get"]
    
      
    
//     )]
#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_VISITEUR')"],
    collectionOperations: [
        "get"=>["normalization_context"=>["groups"=>["menus:write"]]],
        "post" => [ 
            // "security_post_denormalize" => "is_granted('BOOK_CREATE', object)",
            "normalization_context"=>["groups"=>["menus"]],
            "denormalization_context"=>["groups"=>["menus"]]
    ]],
    itemOperations: [
        "get" => [ "security" => "is_granted('BOOK_READ', object)" ],
        "put" => [ "security" => "is_granted('BOOK_EDIT', object)" ],
        "delete" => [ "security" => "is_granted('BOOK_DELETE', object)" ],
    ],
)]
class Menu extends Produit
{
    
  
     #[Groups(["menus"])]
    #[ORM\ManyToMany(targetEntity: Taille::class, inversedBy: 'menus',cascade:["persist"])]
    private $tailles;
    #[Groups(["menus"])]
    #[ORM\ManyToMany(targetEntity: PortionFrite::class, inversedBy: 'menus',cascade:["persist"])]
    private $portionfrites;
    #[Groups(["menus"])]
    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuBurger::class)]
    private $menuBurgers;

    

   
  
  public function __construct()
     {
         $this->tailles = new ArrayCollection();
         $this->portionfrites = new ArrayCollection();
         $this->menuBurgers = new ArrayCollection();
    }
 
     /**
      * @return Collection<int, Taille>
  */
     public function getTailles(): Collection
    {
        return $this->tailles;
    }

     public function addTaille(Taille $taille): self
     {
         if (!$this->tailles->contains($taille)) {
            $this->tailles[] = $taille;
     }

        return $this;
    }

    public function removeTaille(Taille $taille): self
     {
        $this->tailles->removeElement($taille);

        return $this;
 }

     /**
     * @return Collection<int, PortionFrite>
     */
 public function getPortionfrites(): Collection
                {
                    return $this->portionfrites;
                   }

    public function addPortionfrite(PortionFrite $portionfrite): self
    {
        if (!$this->portionfrites->contains($portionfrite)) {
            $this->portionfrites[] = $portionfrite;
        }

        return $this;
    }

     public function removePortionfrite(PortionFrite $portionfrite): self
    {
        $this->portionfrites->removeElement($portionfrite);

        return $this;
     }

     /**
      * @return Collection<int, MenuBurger>
      */
     public function getMenuBurgers(): Collection
     {
         return $this->menuBurgers;
     }

     public function addMenuBurger(MenuBurger $menuBurger): self
     {
         if (!$this->menuBurgers->contains($menuBurger)) {
             $this->menuBurgers[] = $menuBurger;
             $menuBurger->setMenu($this);
         }

         return $this;
     }

     public function removeMenuBurger(MenuBurger $menuBurger): self
     {
         if ($this->menuBurgers->removeElement($menuBurger)) {
             // set the owning side to null (unless already changed)
             if ($menuBurger->getMenu() === $this) {
                 $menuBurger->setMenu(null);
             }
         }

         return $this;
     }

    



 
}
