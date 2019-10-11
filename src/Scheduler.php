<?php

declare(strict_types=1);

namespace newsworthy39;

use newsworthy39\Sites\Site;
use newsworthy39\Schedulable;

class Scheduler implements Schedulable
{
    public function Schedule(Queue $user)
    {

        $tmp = getenv('TIMER');
        $timer = rand(30, 60);
        if (is_string($tmp)) {
            $timer = intval($tmp);
        }

        printf("Scheduler starting, interval %d\n", $timer);
        
        while (true) {
            $sites = Site::FindAll();
            if (is_array($sites)) {
                foreach ($sites as $site) {
                    $site->Schedule($user);
                }
            }

            sleep($timer);
        }

        print("Scheduler stopping");
    }

    public function PerformCheck()
    {
        
    }
}
