<?php
namespace App\DataProvider;

use App\Entity\BlogPost;
use App\Entity\Catalogue;
use App\Repository\BurgerRepository;
use App\Repository\MenuRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

class CatalogueDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $menuRepo;
    private $burgerRepo;

    public function __construct(MenuRepository $menuRepo,BurgerRepository $burgerRepo)
    {
        $this->menuRepo=$menuRepo;
        $this->burgerRepo=$burgerRepo;
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Catalogue::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        
        return [
            ["menu"=> $this->menuRepo->findAll()],
            ["burger"=> $this->burgerRepo->findAll()]
        ];
        

    }
}