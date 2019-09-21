<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use newsworthy39\Scheduler;
use newsworthy39\Queue;

$scheduler = new Scheduler;
$queue = new Queue;

$checks = $scheduler->Schedule($queue);