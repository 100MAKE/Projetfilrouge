<?php
namespace App\Services ;

use App\Entity\Menu;


class CalculPrixMenu{
    /**
     * @param Menu $data
     */
    public function priceMenu($data)
    {
        $prix=0;
        foreach ($data->getMenuBurgers() as $burger) {          
            $prix+=$burger->getBurger()->getPrix()*$burger->getQuantite();
        }

        foreach ($data->getMenuTailles() as $taille) {
            $prix+=$taille->getTaille()->getPrix()*$taille->getQuantite();
        }

        foreach ($data->getMenuPortionFrites() as $portionFrite) {
            $prix+=$portionFrite->getPortionfrite()->getPrix()*$portionFrite->getQuantite();
        }
        return $prix;
    }
}