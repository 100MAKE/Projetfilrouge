<?php
// api/src/Security/Voter/BookVoter.php

namespace App\Security\Voter;

use App\Entity\Menu;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class BookVoter extends Voter
{
    private $security = null;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject): bool
    {
        $supportsAttribute = in_array($attribute, ['BOOK_CREATE', 'BOOK_READ', 'BOOK_EDIT', 'BOOK_DELETE']);
        $supportsSubject = $subject instanceof Menu;

        return $supportsAttribute && $supportsSubject;
    }

    /**
     * @param string $attribute
     * @param Book $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        /** ... check if the user is anonymous ... ["ROLE_GESTIONNAIRE"]**/

        switch ($attribute) {
            case 'BOOK_CREATE':
                if ($this->security->isGranted("ROLE_GESTIONNAIRE")) {
                    return true;
                }  // only admins can create books
                break;
            case 'BOOK_READ':
                /** ... other autorization rules ... **/
        }

        return false;
    }
}
