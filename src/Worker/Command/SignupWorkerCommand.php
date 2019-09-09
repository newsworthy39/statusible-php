<?php declare(strict_types = 1);

namespace newsworthy39\Worker\Command;

class SignupWorkerCommand {
    
    public $email;

    public function __construct(String $email) {
        $this->email = $email;
    }
}