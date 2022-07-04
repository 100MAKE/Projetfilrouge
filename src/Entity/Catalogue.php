<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CatalogueRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
#[ApiResource(
    collectionOperations:["get"]
)]

class Catalogue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    private $menus;
    private $burgers;

    public function __construct()
    {
         $this->menus = new ArrayCollection();
        $this->burgers = new ArrayCollection();
    }

  
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of menus
     */ 
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * Set the value of menus
     *
     * @return  self
     */ 
    public function setMenus($menus)
    {
        $this->menus = $menus;

        return $this;
    }

    /**
     * Get the value of burgers
     */ 
    public function getBurgers()
    {
        return $this->burgers;
    }

    /**
     * Set the value of burgers
     *
     * @return  self
     */ 
    public function setBurgers($burgers)
    {
        $this->burgers = $burgers;

        return $this;
    }
}
