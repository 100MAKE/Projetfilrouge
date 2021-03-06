<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissonRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
#[ApiResource(
    collectionOperations:[
        "post" => [
         "method"=>"post",
        //  "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        //  "security_message"=>"uniquement reserver aux gestionnaires",
         "denormalization_context"=>['group'=>["write"]]
 
        ],
        "get" ]
  )]
class Boisson extends Produit
{

    #[Groups(["write"])]
    #[ORM\ManyToMany(targetEntity: Taille::class, mappedBy: 'boissons',cascade:["persist"])]
    private $tailles;

    public function __construct()
    {
        $this->tailles = new ArrayCollection();
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
            $taille->addBoisson($this);
        }

        return $this;
    }

    public function removeTaille(Taille $taille): self
    {
        if ($this->tailles->removeElement($taille)) {
            $taille->removeBoisson($this);
        }

        return $this;
    }
}
