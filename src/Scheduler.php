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

            $sites = Site::FindAll();
            if (is_array($sites)) {
                foreach ($sites as $site) {
                    $site->Schedule($user);
                }
            }

            sleep(15);
        }
    }
}
