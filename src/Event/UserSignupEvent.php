<?php declare(strict_types = 1);

namespace newsworthy39\Event;
use newsworthy39\User\User;

class UserSignupEvent {
    
    public $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getUser() : User {
        return $this->user;
    }
}