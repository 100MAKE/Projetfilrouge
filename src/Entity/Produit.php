<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use ApiPlatform\Core\Annotation\ApiResource;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "boisson" => "Boisson",
    "burger" => "Burger",
    "menu" => "Menu",
    "portion" => "PortionFrite"
])]
#[ORM\Entity(repositoryClass: ProduitRepository::class)]

#[ApiResource(
    collectionOperations: [
        "get"=>["normalization_context"=>["groups"=>["produit"]]],
        "post" => [
            'status' => Response::HTTP_CREATED,
            
                "normalization_context"=>["groups"=>["produit"]],
                "denormalization_context" => ["groups" => ["produits"]]
            
        ]

    ],
    itemOperations: ["put", "get"]
)]

class Produit
{

    #[Groups(["menus","catalogue","details","com"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;



    #[Groups(["menu", "write", "portion:read:simple", "burger", "menus","catalogue","details"])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nom;

    #[Groups(["menu", "write", "portion:read:simple", "burger", "menus", "menus:write","catalogue","details"])]
    #[ORM\Column(type: 'integer', nullable: true)]
    private $prix;

     #[Groups(["catalogue","details"])]
    #[ORM\Column(type: 'blob', nullable: true)]
    private $image;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $etat;

    #[ORM\ManyToMany(targetEntity: Commande::class, mappedBy: 'produits')]
    private $commandes;



    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'produits')]
    private $gestionnaire;

    #[SerializedName('images')]
    #[Groups(["menus","write"])]
    protected string $fileImage;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["details"])]
    private $description;

    public function __construct()
    {
    }

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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }



    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }



    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    public function getFileImage(): ?string
    {
        return $this->fileImage;
    }

    public function setFileImage(string $fileImage): self
    {
        $this->fileImage = $fileImage;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        // if (is_resource($this->image)) {
        //     return (base64_encode(stream_get_contents($this->image))) ; 
        // }
        // elseif ($this->image) {
        //     (base64_encode($this->image));
        // }
        // return null;
        // dd('ok');

    
         return (is_resource($this->image)) ? utf8_encode(base64_encode(stream_get_contents($this->image))) : $this->image;
        }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;


        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
