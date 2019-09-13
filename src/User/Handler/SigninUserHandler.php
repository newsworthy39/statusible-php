<?php declare(strict_types = 1);

namespace newsworthy39\User\Handler;

use newsworthy39\User\Event\UserSigninEvent;

class SigninUserHandler {
    public function handleUserSigninEvent(UserSigninEvent $event) {
        $user = $event->getUser();
        printf("Customer just logged in. http://statusible.com/user/%s\n.", $user->id);
    }
}