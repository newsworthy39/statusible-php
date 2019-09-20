<?php

declare(strict_types=1);

namespace newsworthy39;

use newsworthy39\Sites\Site;
use newsworthy39\Schedulable;

class Scheduler implements Schedulable
{
    public function Schedule(Queue $user)
    {
        while (true) {
            
            $site = Site::Find(1);

            $checks = $site->Checks();
            if (is_array($checks)) {
                foreach ($checks as $check) {
                    $check->Schedule($user);
                }
            }


            sleep(15);
        }
    }
}
