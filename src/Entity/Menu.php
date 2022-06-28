<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ORM\InheritanceType("JOINED")]
class Menu extends Produit
{
    #[ORM\ManyToMany(targetEntity: Burger::class, mappedBy: 'menus')]
    private $burgers;

    #[ORM\ManyToMany(targetEntity: Complements::class, inversedBy: 'menus')]
    private $complements;

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
