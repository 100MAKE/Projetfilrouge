<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

use App\Repository\DetailsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
#[ApiResource(
    // collectionOperations:[],
    itemOperations: ["get"=>[
        "normalization_context"=>["groups"=>["details"]]]]
        
)]

class Details
{
    #[Groups("details")]
    public ?int $id = null;

    #[Groups("details")]
    public ?Menu $menu = null;

    #[Groups("details")]
    public ?Burger $burger = null;

    #[Groups("details")]
    public array $boisson;
    
    #[Groups("details")]
    public array $portionfrite;

   
}
