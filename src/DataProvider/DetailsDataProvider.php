<?php
namespace App\DataProvider;

use App\Entity\Details;
use App\Repository\MenuRepository;
use App\Repository\BurgerRepository;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\BoissonRepository;
use App\Repository\PortionFriteRepository;

class DetailsDataProvider implements  RestrictedDataProviderInterface,ItemDataProviderInterface
{
    private $menu;
    private $burger;
    private $boisson;
    private $portionFrite;

    

    public function __construct(MenuRepository $menuRepo,BurgerRepository $burgerRepo,BoissonRepository $boissonRepo,PortionFriteRepository $portionFriteRepo)
    {
        $this->menu=$menuRepo;
        $this->burger=$burgerRepo;
        $this->boisson=$boissonRepo;
        $this->portionFrite=$portionFriteRepo;


    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Details::class === $resourceClass;
    }

    public function getItem(string $resourceClass ,$id ,string $operationName = null, array $context = []): ?Details
    {   $details= new Details;
        // dd($details);
        $details->id=$id;
        ($this->menu->find($id)!=null)?
        $details->menu=$this->menu->find($id):
        $details->burger=$this->burger->find($id);
        $details->boisson=$this->boisson->findAll();
        $details-> portionfrite=$this->portionFrite->findAll();
//   dd($details);
        return $details;
    }
} 