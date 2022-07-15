<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TailleRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TailleRepository::class)]
#[ApiResource(
    collectionOperations:[
        "post" => [
         "method"=>"post",
        //  "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        //  "security_message"=>"uniquement reserver aux gestionnaires",
         "denormalization_context"=>['group'=>["write"]]
 
     ]]
  )]
class Taille
{ 

     #[Groups(["menus"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[Groups(['write',"menus"])]
    #[ORM\Column(type: 'integer',nullable: true)]
    private $prix;

    #[Groups(['write',"menus"])]
    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    // #[Groups("menus")]
    #[ORM\ManyToMany(targetEntity: Boisson::class, inversedBy: 'tailles')]
    private $boissons;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'tailles')]
    private $menus;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: MenuTaille::class)]
    private $menuTailles;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: CommandeTaille::class)]
    private $commandeTailles;


    

    public function __construct()
    {
        $this->boissons = new ArrayCollection();
        $this->menuTailles = new ArrayCollection();
        $this->commandeTailles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Boisson>
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(Boisson $boisson): self
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons[] = $boisson;
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        $this->boissons->removeElement($boisson);

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
            $menuTaille->setTaille($this);
        }

        return $this;
    }

    public function removeMenuTaille(MenuTaille $menuTaille): self
    {
        if ($this->menuTailles->removeElement($menuTaille)) {
            // set the owning side to null (unless already changed)
            if ($menuTaille->getTaille() === $this) {
                $menuTaille->setTaille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeTaille>
     */
    public function getCommandeTailles(): Collection
    {
        return $this->commandeTailles;
    }

    public function addCommandeTaille(CommandeTaille $commandeTaille): self
    {
        if (!$this->commandeTailles->contains($commandeTaille)) {
            $this->commandeTailles[] = $commandeTaille;
            $commandeTaille->setTaille($this);
        }

        return $this;
    }

    public function removeCommandeTaille(CommandeTaille $commandeTaille): self
    {
        if ($this->commandeTailles->removeElement($commandeTaille)) {
            // set the owning side to null (unless already changed)
            if ($commandeTaille->getTaille() === $this) {
                $commandeTaille->setTaille(null);
            }
        }

        return $this;
    }

    

   

   

   
    
}
