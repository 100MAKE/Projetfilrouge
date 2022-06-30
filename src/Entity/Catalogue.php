<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CatalogueRepository;
use ApiPlatform\Core\Annotation\ApiResource;
#[ApiResource(
    collectionOperations:["get","post"],
    itemOperations:["put","get"]
    
      
    
    )]

class Catalogue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
