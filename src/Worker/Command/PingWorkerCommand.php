<?php declare(strict_types = 1);

namespace newsworthy39\Worker\Command;

class PingWorkerCommand {
    
    public $url;

    public function __construct(String $url) {
        $this->url = $url;
    }
}
