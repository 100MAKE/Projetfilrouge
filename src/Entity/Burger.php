<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
    collectionOperations:["get",
    "post" => [
        "method"=>"post",
        // "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        // "security_message"=>"uniquement reserver aux gestionnaires",
             "denormalization_context"=>["groups"=>["menus"]],
        'normalization_context' => ['groups' => ['menus']]

       ]],
    itemOperations:["put","get"]
    
      
    
    )]
class Burger extends Produit
{

    #[ORM\OneToMany(mappedBy: 'burger', targetEntity: MenuBurger::class,cascade:["persist"])]
    private $menuBurgers;

    #[ORM\OneToMany(mappedBy: 'burger', targetEntity: CommandeBurger::class)]
    private $commandeBurgers;

    public function __construct()
    {
        $this->menuBurgers = new ArrayCollection();
        $this->commandeBurgers = new ArrayCollection();
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
            $menuBurger->setBurger($this);
        }

        return $this;
    }

    public function removeMenuBurger(MenuBurger $menuBurger): self
    {
        if ($this->menuBurgers->removeElement($menuBurger)) {
            // set the owning side to null (unless already changed)
            if ($menuBurger->getBurger() === $this) {
                $menuBurger->setBurger(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeBurger>
     */
    public function getCommandeBurgers(): Collection
    {
        return $this->commandeBurgers;
    }

    public function addCommandeBurger(CommandeBurger $commandeBurger): self
    {
        if (!$this->commandeBurgers->contains($commandeBurger)) {
            $this->commandeBurgers[] = $commandeBurger;
            $commandeBurger->setBurger($this);
        }

        return $this;
    }

    public function removeCommandeBurger(CommandeBurger $commandeBurger): self
    {
        if ($this->commandeBurgers->removeElement($commandeBurger)) {
            // set the owning side to null (unless already changed)
            if ($commandeBurger->getBurger() === $this) {
                $commandeBurger->setBurger(null);
            }
        }

        return $this;
    }

}
