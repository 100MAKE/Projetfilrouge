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
#[ApiResource(
    collectionOperations:["get",
    "post" => [
    "method"=>"post",
    // "security"=>"is_granted('ROLE_GESTIONNAIRE')",
    // "security_message"=>"uniquement reserver aux gestionnaires",
    // "denormalization_context"=>['group'=>["menu"]]

       ]],
    itemOperations:["put","get"]
    
      
    
    )]
class Menu extends Produit
{
    #[Groups(["menu"])]
     #[ORM\ManyToMany(targetEntity: Burger::class, mappedBy: 'menus',cascade:["persist"])]
     private $burgers;

 #[ORM\ManyToMany(targetEntity: Taille::class, inversedBy: 'menus',cascade:["persist"])]
 private $tailles;

     #[ORM\ManyToMany(targetEntity: PortionFrite::class, inversedBy: 'menus',cascade:["persist"])]
    private $portionfrites;

    

   
  
  public function __construct()
     {
  $this->burgers = new ArrayCollection();
   $this->tailles = new ArrayCollection();
         $this->portionfrites = new ArrayCollection();
    }
     /**
     * @return Collection<int, Burger>
  */
     public function getBurgers(): Collection
     {
     return $this->burgers;
     }

     public function addBurger(Burger $burger): self
     {
         if (!$this->burgers->contains($burger)) {
             $this->burgers[] = $burger;
            $burger->addMenu($this);
         }

        return $this;
     }

     public function removeBurger(Burger $burger): self
     {
        if ($this->burgers->removeElement($burger)) {
           $burger->removeMenu($this);
        }

        return $this;
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

    



 
}
