<?php

declare(strict_types=1);

namespace newsworthy39\Factory\Database\Migrations;

class SystemIndexes
{

    public function up()
    {
        $indexes = array(
            "CREATE INDEX idx_users_nickname on users(nickname)",
            "CREATE INDEX idx_sites_identifiers on sites(identifier)"
        );

        return array_merge($indexes);
    }

    public function down()
    {
        return [];
    }
}
