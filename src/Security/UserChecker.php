<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 19/02/2019
 * Time: 23:22
 */

namespace App\Security;


use App\Entity\User;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{

    /**
     * Checks the user account before authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof User) {
            return;
        }
        // user is deleted, show a generic Account Not Found message.
        if (!$user->getValidation()) {
            // or to customize the message shown
            throw new DisabledException();
            /*throw new CustomUserMessageAuthenticationException(
                'Your account was disabled. Sorry about that!'
            );*/
        }
    }

    /**
     * Checks the user account after authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof User) {
            return;
        }
    }
}