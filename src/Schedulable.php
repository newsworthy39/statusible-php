<?php
declare (strict_types=1);
namespace newsworthy39;

use newsworthy39\Queue;

interface Schedulable {

    public function Schedule(Queue $queue);

}