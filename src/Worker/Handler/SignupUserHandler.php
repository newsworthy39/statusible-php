<?php declare(strict_types = 1);

namespace newsworthy39\Worker\Handler;

use newsworthy39\Event\UserSignupEvent;

class SignupUserHandler {
    public function handleUserSignupEvent(UserSignupEvent $event) {
        $user = $event->getUser();
        printf("Customer just signed up. http://statusible.com/token/%s/resetpassword\n.", $user->token);
    }
}