<?php declare(strict_types = 1);

namespace newsworthy39\Check\Command;

use newsworthy39\Check\Check;

class CheckWorkerCommand {
    
    private $instance;    

    public function __construct(Check $check) {
        $this->instance = $check;
    }

    public function getCheck() : Check {
        return $this->instance;
    }
}
