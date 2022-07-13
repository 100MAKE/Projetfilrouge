<?php

namespace App\Security\Voter;

use App\Entity\Commande;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class SecurityVoter extends Voter
{
    private $security = null;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    protected function supports($attribute, $subject): bool
    {
        $supportsAttribute = in_array($attribute, ['G_CREATE', 'G_READ', 'G_EDIT', 'G_DELETE']);
        $supportsSubject = $subject instanceof Commande;

        return $supportsAttribute && $supportsSubject;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'G_CREATE':
                if ($this->security->isGranted("ROLE_GESTIONNAIRE")) {
                    return true;


                }
                break;
            // case self::VIEW:
            //     // logic to determine if the user can VIEW
            //     // return true or false
            //     break;
        }

        return false;
    }
}
