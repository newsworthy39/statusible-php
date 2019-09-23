<?php

declare(strict_types=1);

namespace newsworthy39\Search;

use newsworthy39\Elegant;
use newsworthy39\Sites\Site;
use newsworthy39\User\User;

final class Search extends Elegant
{

    // something with strategies, and shit.
    public static function FindSites(array $args)
    {
        return self::findModels(Site::CreateEmpty(), $args);
    }

    // something with strategies, and shit.
    public static function FindUsers(array $args)
    {
        return self::findModels(User::CreateEmpty(), $args);
    }
}
