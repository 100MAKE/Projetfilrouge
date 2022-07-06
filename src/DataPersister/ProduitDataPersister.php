<?php

// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;

use App\Entity\Menu;
use App\Entity\Produit;
use App\Services\CalculPrixMenu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 *
 */
class ProduitDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;
    private $security;
    private $token;
    public function __construct(CalculPrixMenu $calculPrixMenu, EntityManagerInterface $entityManager, Security $security, TokenStorageInterface $token)
    {

        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->token = $token;
        $this->calculPrixMenu = $calculPrixMenu;
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
        if ($data instanceof Produit) {
            $data->setGestionnaire($this->token->getToken()->getUser());
        }
        if ($data instanceof Menu) {
            $data->setPrix($this->calculPrixMenu->priceMenu($data));
        }
        $this->entityManager->persist($data);
        $this->entityManager->flush();
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
