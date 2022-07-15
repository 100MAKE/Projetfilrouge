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
// 'denormalization_context'=>['groups'=>['portion:read:simple']]

    ]
],
    itemOperations:["put","get"]
    )]
class PortionFrite extends Produit
{     
    #[ORM\OneToMany(mappedBy: 'portionfrite', targetEntity: MenuPortionFrite::class,cascade:["persist"])]
    private $menuPortionFrites;

    #[ORM\OneToMany(mappedBy: 'portionfrite', targetEntity: CommandePortionFrite::class)]
    private $commandePortionFrites;

    //  #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'portionfrites')]
    // private $menus;

    public function __construct()
    {
        $this->menuPortionFrites = new ArrayCollection();
        $this->commandePortionFrites = new ArrayCollection();
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
            $menuPortionFrite->setPortionfrite($this);
        }

        return $this;
    }

    public function removeMenuPortionFrite(MenuPortionFrite $menuPortionFrite): self
    {
        if ($this->menuPortionFrites->removeElement($menuPortionFrite)) {
            // set the owning side to null (unless already changed)
            if ($menuPortionFrite->getPortionfrite() === $this) {
                $menuPortionFrite->setPortionfrite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandePortionFrite>
     */
    public function getCommandePortionFrites(): Collection
    {
        return $this->commandePortionFrites;
    }

    public function addCommandePortionFrite(CommandePortionFrite $commandePortionFrite): self
    {
        if (!$this->commandePortionFrites->contains($commandePortionFrite)) {
            $this->commandePortionFrites[] = $commandePortionFrite;
            $commandePortionFrite->setPortionfrite($this);
        }

        return $this;
    }

    public function removeCommandePortionFrite(CommandePortionFrite $commandePortionFrite): self
    {
        if ($this->commandePortionFrites->removeElement($commandePortionFrite)) {
            // set the owning side to null (unless already changed)
            if ($commandePortionFrite->getPortionfrite() === $this) {
                $commandePortionFrite->setPortionfrite(null);
            }
        }

        return $this;
    }
}
