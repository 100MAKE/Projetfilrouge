<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

use App\Repository\DetailsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
#[ApiResource(
    itemOperations: ["get"=>[
        "normalization_context"=>["groups"=>["details"]]]]
        
)]

class Details
{
   
     public ?int $id = null;

    
    #[Groups("details")]
    public Burger|Menu $produit ;
    
    #[Groups("details")]
    public array $boissons;
    
    #[Groups("details")]
    public array $frites;

   
}
