<?php declare(strict_types = 1);

namespace newsworthy39\Check\Handler;

use newsworthy39\Check\Command\CheckWorkerCommand;

class CheckWorkerHandler {

    public function handleCheckWorkerCommand(CheckWorkerCommand $command) {
        $command->getCheck()->PerformCheck();

    }
}