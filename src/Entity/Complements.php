<?php

namespace App\Entity;

use App\Repository\ComplementsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource(
    collectionOperations: ["get",],
    itemOperations: []
)]

class Complements
{
    private $id;

    private $tailles;

    private $portionfrites;

    public function __construct()
    {
         $this->menus = new ArrayCollection();
        $this->tailles = new ArrayCollection();
        $this->portionfrites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTailles(): Collection
    {
        return $this->tailles;
    }

    public function getPortionfrites(): Collection
    {
        return $this->portionfrites;
    }
}
