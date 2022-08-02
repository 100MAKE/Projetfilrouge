<?php

// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * 
 */
class CommandeDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;
    private $security;
    private TokenInterface $token;
    public function __construct( EntityManagerInterface $entityManager, Security $security, TokenStorageInterface $tokens)
    {

        $this->entityManager = $entityManager;
        $this->security = $security;
    //   $this->token = $tokens->getToken();            
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Commande ;
    }

    /**
     * @param Commande $data
     */
    public function persist($data, array $context = [])
    {    
    //     foreach ($data->getCommandeTailles() as $taille ) {
         
    //     $som1=$taille->getTaille()->getPrix()*$taille->getQuantite();
    //    }
       foreach ( $data->getCommandeBurgers() as $burg) {
        
        $som2=$burg->getBurger()->getPrix()*$burg->getQuantite();
        
       }
       foreach ($data->getCommandeMenus() as $men ) {
       
        $som3=$men->getMenu()->getPrix()*$men->getQuantite();

       }

       $data->setMontant($som2+$som3);


       $data->setClient($this->token->getUser());
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
