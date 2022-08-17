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
        "normalization_context"=>["groups"=>["menus"]],

         "denormalization_context"=>['group'=>["menus"]]
 
        ],
        "get" ]
  )]
class Boisson extends Produit
{
   
    #[ORM\OneToMany(mappedBy: 'boisson', targetEntity: TailleBoisson::class)]
    private $tailleBoissons;

   
    

    public function __construct()
    {
        $this->tailleBoissons = new ArrayCollection();
    }

  
    /**
     * @return Collection<int, TailleBoisson>
     */
    public function getTailleBoissons(): Collection
    {
        return $this->tailleBoissons;
    }

    public function addTailleBoisson(TailleBoisson $tailleBoisson): self
    {
        if (!$this->tailleBoissons->contains($tailleBoisson)) {
            $this->tailleBoissons[] = $tailleBoisson;
            $tailleBoisson->setBoisson($this);
        }

        return $this;
    }

    public function removeTailleBoisson(TailleBoisson $tailleBoisson): self
    {
        if ($this->tailleBoissons->removeElement($tailleBoisson)) {
            // set the owning side to null (unless already changed)
            if ($tailleBoisson->getBoisson() === $this) {
                $tailleBoisson->setBoisson(null);
            }
        }

        return $this;
    }

 
}
