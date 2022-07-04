<?php
namespace App\DataProvider;

use App\Entity\BlogPost;
use App\Entity\Complements;
use App\Repository\TailleRepository;
use App\Repository\PortionFriteRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

final class ComplementsDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $portionfriteRepo;
    private $tailleRepo;

    public function __construct(PortionFriteRepository $portionfriteRepo,TailleRepository $tailleRepo)
    {
        $this->portionfriteRepo=$portionfriteRepo;
        $this->tailleRepo=$tailleRepo;
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Complements::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
       
        return [
            ["portionfrite"=> $this->portionfriteRepo->findAll()],
            ["taille"=> $this->tailleRepo->findAll()]
        ];
    }
}