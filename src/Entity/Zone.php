<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ZoneRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ZoneRepository::class)]
#[ApiResource(
    collectionOperations: [
        "post" => [
            'denormalization_context' => ["groups" => ["zones:details"]],
            "normalization_context" => ["groups" => ["zones:details:all"]]
        ],
        "get" => [
            'denormalization_context' => ["groups" => ["zone:details"]],
            "normalization_context" => ["groups" => ["zone:details:all"]]
        ],
    ]
)]
// #[ApiResource(
//     collectionOperations:[ "get"=>["normalization_context"=>["groups"=>["zone"]]],
//     "post" => [
//         "method"=>"post",
//          "security"=>"is_granted('ROLE_GESTIONNAIRE')",
//          "security_message"=>"uniquement reserver aux gestionnaires",
//         'denormalization_context'=>["group"=>["zones:details"]],
//         // 'normalization_context' => ["groups" => ["zone"]]

//        ]],
//     itemOperations:["put","get"]



//     )]
class Zone
    {    
    #[ORM\Id]
    #[Groups(['comr','com','zone:details:all', 'zone:details'])]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['zone:details:all', 'zone:details','comr','com'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[Groups(['zone:details:all', 'zone:details','comr','com'])]
    #[ORM\Column(type: 'integer')]
    private $pix;

    #[Groups(['zones:details:all', 'zones:details'])]
    #[ORM\OneToMany(mappedBy: 'zone', targetEntity: Quartier::class, cascade: ["persist"])]
    private $quartiers;

    #[ORM\OneToMany(mappedBy: 'zone', targetEntity: Commande::class, cascade: ["persist"])]
    private $commandes;

  

    public function __construct()
    {
        $this->quartiers = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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

    public function getPix(): ?int
    {
        return $this->pix;
    }

    public function setPix(int $pix): self
    {
        $this->pix = $pix;

        return $this;
    }

    /**
     * @return Collection<int, Quartier>
     */
    public function getQuartiers(): Collection
    {
        return $this->quartiers;
    }

    public function addQuartier(Quartier $quartier): self
    {
        if (!$this->quartiers->contains($quartier)) {
            $this->quartiers[] = $quartier;
            $quartier->setZone($this);
        }

        return $this;
    }

    public function removeQuartier(Quartier $quartier): self
    {
        if ($this->quartiers->removeElement($quartier)) {
            // set the owning side to null (unless already changed)
            if ($quartier->getZone() === $this) {
                $quartier->setZone(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setZone($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getZone() === $this) {
                $commande->setZone(null);
            }
        }

        return $this;
    }

   
}