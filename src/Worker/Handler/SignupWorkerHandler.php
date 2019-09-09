<?php declare(strict_types = 1);

namespace newsworthy39\Worker\Handler;
use newsworthy39\Worker\Command\SignupWorkerCommand;

class SignupWorkerHandler {
    public function handleSignupWorkerCommand(SignupWorkerCommand $command) {
        $randomnumber = rand( 100, 10000);
        printf("Customer just signed up. http://statusible.com/resetpassword?email=%s&token=%s\n.", htmlentities($command->email), $randomnumber);
    }
}