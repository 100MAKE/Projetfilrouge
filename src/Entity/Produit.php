<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type",type:"string")]
#[ORM\DiscriminatorMap([
"boisson"=>"Boisson",
 "burger"=>"Burger",
 "menu"=>"Menu",
 "portion"=>"PortionFrite"
 ])]
#[ORM\Entity(repositoryClass: ProduitRepository::class)]

#[ApiResource(
    collectionOperations:[
    "get",
    "post" => [
    'status' => Response::HTTP_CREATED,
    'normalization_context' => ['groups' => ['write:simple','write']],
        ]    

    ],
    itemOperations:["put","get"])]

class Produit
{
    #[Groups(["write","menu","burger"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(["menu","write","portion:read:simple","burger"])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nom;

    #[Groups(["menu","write","portion:read:simple","burger"])]
    #[ORM\Column(type: 'float', nullable: true)]
    private $prix;

    #[Groups(["burger"])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

     #[ORM\Column(type: 'string', length: 255, nullable: true)]
     private $etat="true";

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    // public function getEtat(): ?string
    // {
    //     return $this->etat;
    // }

    // public function setEtat(string $etat): self
    // {
    //     $this->etat = $etat;

    //     return $this;
    // }
}
