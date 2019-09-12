<?php

declare(strict_types=1);

namespace newsworthy39\Factory\Database;
use newsworthy39\Factory\Tinker;

class System {
    
    public function up() {
        $tables = array(
            "CREATE TABLE `content` (id integer not null primary key auto_increment)",
            "CREATE TABLE `users` (id integer not null primary key auto_increment, email varchar(255) not null, token varchar(64), password varchar(255) default '')"
        );

        $sqls = array(
            "INSERT INTO users (email, token) VALUES ('test1@test.com', '1234567890123456')"
        );
            
        return array_merge($tables,$sqls);
    }

    public function down() {
        $tables = array(
            "DROP TABLE `users`",
            "DROP TABLE `content`"
        );
            
        return $tables;
    }
}