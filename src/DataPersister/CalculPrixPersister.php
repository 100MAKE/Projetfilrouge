<?php

// src/DataPersister/UserDataPersister.php

namespace App\DataPersister\CalculPrixPersiter;

use App\Entity\Menu;
use App\Services\CalculPrixMenuService;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

/**
 *
 */
class CalculPrixPersiter implements ContextAwareDataPersisterInterface
{

    public function __construct(EntityManagerInterface $entityManager, CalculPrixMenuService $calculPrixMenuService
    ) {
        $this->entityManager = $entityManager;
        $this-> calculPrixMenuService = $calculPrixMenuService; 
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Menu;
    }

    /**
     * @param Menu $data
     */
    public function persist($data, array $context = [])
    {
       $prix=$this->calculPrixMenuService->getMenuPrice($data);
        $data->setPrix($prix);
        $this-> entityManager->persist($data);
        $this-> entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
