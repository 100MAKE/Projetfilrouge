<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProduitCommandeRepository;
#[ApiResource(
    collectionOperations:["get",
"post"=>[
"method"=>"post",
// "security"=>"is_granted('ROLE_GESTIONNAIRE')",
"security_message"=>"uniquement reserver aux gestionnaires",
'denormalization_context'=>['groups'=>['produit:read:simple']]

    ]
],
    itemOperations:["put","get"]
    )]

#[ORM\Entity(repositoryClass: ProduitCommandeRepository::class)]
class ProduitCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $quantiteProduit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiteProduit(): ?int
    {
        return $this->quantiteProduit;
    }

    public function setQuantiteProduit(int $quantiteProduit): self
    {
        $this->quantiteProduit = $quantiteProduit;

        return $this;
    }
}
