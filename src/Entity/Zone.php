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
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['zones:details:all', 'zones:details'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[Groups(['zones:details:all', 'zones:details'])]
    #[ORM\Column(type: 'integer')]
    private $pix;

    #[Groups(['zones:details:all', 'zones:details'])]
    #[ORM\OneToMany(mappedBy: 'zone', targetEntity: Quartier::class, cascade: ["persist"])]
    private $quartiers;

    public function __construct()
    {
        $this->quartiers = new ArrayCollection();
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
}
