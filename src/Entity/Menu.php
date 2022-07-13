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
    attributes: ["security" => "is_granted('ROLE_GESTIONNAIRE')"],
    collectionOperations: [
        "get"=>["normalization_context"=>["groups"=>["menus:write"]]],
        "post" => [ 
            // "security_post_denormalize" => "is_granted('BOOK_CREATE', object)",
             "normalization_context"=>["groups"=>["menus"]],
             "denormalization_context"=>["groups"=>["menus"]]
    ]],
    itemOperations: [
        "get" => [ "security" => "is_granted('G_READ', object)" ],
        "put" => [ "security" => "is_granted('G_EDIT', object)" ],
        "delete" => [ "security" => "is_granted('G_DELETE', object)" ],
    ],
)]
class Menu extends Produit
{
    
  
    #[Groups("menus")]
    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuBurger::class,cascade:["persist"])]
    private $menuBurgers;
    
    #[Groups("menus")]
    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuTaille::class,cascade:["persist"])]
    private $menuTailles;
    
    #[Groups("menus")]
    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuPortionFrite::class,cascade:["persist"])]
    private $menuPortionFrites;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: CommandeMenu::class)]
    private $commandeMenus;

    

   
  
  public function __construct()
     {
         $this->menuBurgers = new ArrayCollection();
         $this->menuTailles = new ArrayCollection();
         $this->menuPortionFrites = new ArrayCollection();
         $this->commandeMenus = new ArrayCollection();
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

     /**
      * @return Collection<int, MenuTaille>
      */
     public function getMenuTailles(): Collection
     {
         return $this->menuTailles;
     }

     public function addMenuTaille(MenuTaille $menuTaille): self
     {
         if (!$this->menuTailles->contains($menuTaille)) {
             $this->menuTailles[] = $menuTaille;
             $menuTaille->setMenu($this);
         }

         return $this;
     }

     public function removeMenuTaille(MenuTaille $menuTaille): self
     {
         if ($this->menuTailles->removeElement($menuTaille)) {
             // set the owning side to null (unless already changed)
             if ($menuTaille->getMenu() === $this) {
                 $menuTaille->setMenu(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection<int, MenuPortionFrite>
      */
     public function getMenuPortionFrites(): Collection
     {
         return $this->menuPortionFrites;
     }

     public function addMenuPortionFrite(MenuPortionFrite $menuPortionFrite): self
     {
         if (!$this->menuPortionFrites->contains($menuPortionFrite)) {
             $this->menuPortionFrites[] = $menuPortionFrite;
             $menuPortionFrite->setMenu($this);
         }

         return $this;
     }

     public function removeMenuPortionFrite(MenuPortionFrite $menuPortionFrite): self
     {
         if ($this->menuPortionFrites->removeElement($menuPortionFrite)) {
             // set the owning side to null (unless already changed)
             if ($menuPortionFrite->getMenu() === $this) {
                 $menuPortionFrite->setMenu(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection<int, CommandeMenu>
      */
     public function getCommandeMenus(): Collection
     {
         return $this->commandeMenus;
     }

     public function addCommandeMenu(CommandeMenu $commandeMenu): self
     {
         if (!$this->commandeMenus->contains($commandeMenu)) {
             $this->commandeMenus[] = $commandeMenu;
             $commandeMenu->setMenu($this);
         }

         return $this;
     }

     public function removeCommandeMenu(CommandeMenu $commandeMenu): self
     {
         if ($this->commandeMenus->removeElement($commandeMenu)) {
             // set the owning side to null (unless already changed)
             if ($commandeMenu->getMenu() === $this) {
                 $commandeMenu->setMenu(null);
             }
         }

         return $this;
     }

    



 
}
