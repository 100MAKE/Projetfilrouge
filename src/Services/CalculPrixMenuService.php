<?php
namespace App\Services;
use App\Entity\Menu;
use PhpParser\Builder\Class_;


Class CalculPrixMenuService{

    public function getMenuPrice(Menu $datamenu)
    {
        $prix = 0;
        foreach ($datamenu->getPortionFrites() as  $portionfrite) {
            # code...
            $prix += $portionfrite->getPrix();
        }

        foreach ($datamenu->getBurgers() as  $burgers) {
            # code...
            $prix += $burgers->getPrix();
        }

        foreach ($datamenu->getTailles() as  $taille) {
            # code...
            $prix += $taille->getPrix();
        }

        return $prix;
    }
}