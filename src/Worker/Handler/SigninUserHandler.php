<?php declare(strict_types = 1);

namespace newsworthy39\Worker\Handler;

use newsworthy39\Event\UserSigninEvent;

class SigninUserHandler {
    public function handleUserSigninEvent(UserSigninEvent $event) {
        $user = $event->getUser();
        printf("Customer just logged in. http://statusible.com/user/%s\n.", $user->id);
    }
}