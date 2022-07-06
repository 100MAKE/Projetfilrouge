<?php

// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Security;

/**
 *
 */
class ProduitDataPersister implements ContextAwareDataPersisterInterface
{      private $entityManager;
       private $security;
    public function __construct(EntityManagerInterface $entityManager,Security $security) 
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
        
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Produit;
    }

    /**
     * @param Produit $data
     */
    public function persist($data, array $context = [])
    {
        if ( $data instanceof Produit ) {
            $data->setGestionnaire($this->security->getUser());
        }
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
