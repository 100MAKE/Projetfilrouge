<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ApiResource(
    collectionOperations:["get","post"],
    itemOperations:["put","get"]
    
      
    
    )]
class Menu extends Produit
{
    #[ORM\ManyToMany(targetEntity: Burger::class, mappedBy: 'menus')]
    private $burgers;

   
    public function __construct()
    {
        $this->burgers = new ArrayCollection();
        $this->complements = new ArrayCollection();
    }

    /**
     * @return Collection<int, Burger>
     */
    public function getBurgers(): Collection
    {
        return $this->burgers;
    }

    // public function addBurger(Burger $burger): self
    // {
    //     if (!$this->burgers->contains($burger)) {
    //         $this->burgers[] = $burger;
    //         $burger->addMenu($this);
    //     }

    //     return $this;
    // }

    // public function removeBurger(Burger $burger): self
    // {
    //     if ($this->burgers->removeElement($burger)) {
    //         $burger->removeMenu($this);
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, Complements>
     */
    public function getComplements(): Collection
    {
        return $this->complements;
    }

    public function addComplement(Complements $complement): self
    {
        if (!$this->complements->contains($complement)) {
            $this->complements[] = $complement;
        }

        return $this;
    }

    public function removeComplement(Complements $complement): self
    {
        $this->complements->removeElement($complement);

        return $this;
    }
}
