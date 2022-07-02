<?php
namespace App\DataProvider;

use App\Entity\BlogPost;
use App\Entity\Complement;
use App\Repository\TailleRepository;
use App\Repository\PortionFriteRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

final class ComplementDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $portionfriteRepo;
    private $tailleRepo;

    public function __construct(PortionFriteRepository $portionfriteRepo,TailleRepository $tailleRepo)
    {
        $this->portionfriteRepo=$portionfriteRepo;
        $this->tailleRepo=$portionfriteRepo;
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Complement::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $complements = [];
        [$complements="portionfrite"=> $this->portionfriteRepo->findAll()];
        [$complements="taille"=> $this->tailleRepo->findAll()];

        return $complements;
    }
}