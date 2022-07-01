<?php
// api/src/DataProvider/BlogPostCollectionDataProvider.php

namespace App\DataProvider;
use App\Repository\MenuRepository;
use App\Repository\BurgerRepository;
use App\Entity\Complements;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

final class ComplementDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{    
    private $menuRepo;
    private $burgerRepo;
    public function __construct(MenuRepository $menuRepo, BurgerRepository $burgerRepo)
    {
        
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return  ComplementDataProvider ::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        
    }
}