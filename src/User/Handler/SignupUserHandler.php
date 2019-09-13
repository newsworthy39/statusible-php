<?php declare(strict_types = 1);

namespace newsworthy39\User\Handler;

use newsworthy39\User\Event\UserSignupEvent;

class SignupUserHandler {
    public function handleUserSignupEvent(UserSignupEvent $event) {
        $user = $event->getUser();
        printf("Customer just signed up. http://statusible.com/token/%s/resetpassword\n.", $user->token);
    }
}