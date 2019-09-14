<?php

declare(strict_types=1);

namespace newsworthy39\Factory\Database;
use newsworthy39\Factory\Tinker;

class System {
    
    public function up() {
        $tables = array(
            "CREATE TABLE IF NOT EXISTS `migrations` (id integer not null primary key auto_increment, classname varchar(255) not null default '')",
            "CREATE TABLE IF NOT EXISTS `content` (id integer not null primary key auto_increment)",
            "CREATE TABLE IF NOT EXISTS `users` (id integer not null primary key auto_increment, email varchar(255) not null, token varchar(64), password varchar(255) default '', tfasalt varchar(64) default '', nickname varchar(255) not null default '')",
            "CREATE TABLE IF NOT EXISTS `team` (id integer not null primary key auto_increment, name varchar(255) not null)",
            "CREATE TABLE IF NOT EXISTS `users_team_roles`(id integer not null primary key auto_increment, userid integer not null references users(id), teamid integer not null references team(id))",
            "CREATE TABLE IF NOT EXISTS `checks` (id integer not null primary key auto_increment, usersid integer not null references users(id), identifier char(64) not null default '')"
        );

      
            
        return $tables;
    }

    public function down() {
        $tables = array(
            "DROP TABLE `content`",
            "DROP TABLE `users`",
            "DROP TABLE `team`",
            "DROP TABLE `users_team_roles`",
            "DROP TABLE `checks`",
            "TRUNCATE TABLE `migrations`"
        );
            
        return $tables;
    }
}