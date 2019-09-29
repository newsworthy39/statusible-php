<?php

declare(strict_types=1);

namespace newsworthy39\Factory\Database;

use newsworthy39\Factory\Tinker;

class System
{

    public function up()
    {
        $tables = array(
            "CREATE TABLE IF NOT EXISTS `migrations` (id integer not null primary key auto_increment, classname varchar(255) not null default '')",
            "CREATE TABLE IF NOT EXISTS `users` (id integer not null primary key auto_increment, email varchar(255) not null, token varchar(64), password varchar(255) default '', tfasalt varchar(64) default '', nickname varchar(255) not null default '', created timestamp default CURRENT_TIMESTAMP, preferredplan integer not null default 0)",
            "CREATE TABLE IF NOT EXISTS `team` (id integer not null primary key auto_increment, teamname varchar(255) not null, owerid integer not null references users(id))",
            "CREATE TABLE IF NOT EXISTS `users_teams` (id integer not null primary key auto_increment, userid integer not null references users(id), teamid integer not null references team(id), roleid integer not null references role(id))",
            "CREATE TABLE IF NOT EXISTS `sites` (id integer not null primary key auto_increment, usersid integer not null references users(id), identifier char(64) not null default '', screenshot varchar(255) not null default '', created timestamp not null default now())",
            "CREATE TABLE IF NOT EXISTS `checks` (id integer not null primary key auto_increment, sitesid integer not null references sites(id), identifier char(64) not null default '', typeofservice integer not null default 0, created timestamp not null default now(), lastupdated timestamp not null default '2000-01-01 00:00:00',  endpoint varchar(255) not null, activecheck integer not null default 0, enabled integer not null default 0)",
            "CREATE TABLE IF NOT EXISTS `sites_depends` (id integer not null primary key auto_increment, leftid integer not null references sites(id), rightid integer not null references sites(id), enabled tinyint(1) not null default 0)",
            "CREATE INDEX idx_users_nickname on users(nickname)",
            "CREATE INDEX idx_sites_identifiers on sites(identifier)"
        );

        $users = array(
            "INSERT INTO users (email, token, password, nickname) VALUES ('michaeljensendk@hotmail.com','1','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'newsworthy39')"
        );

        return array_merge($tables, $users);
    }

    public function down()
    {
        $tables = array(

            "DROP TABLE `users`",
            "DROP TABLE `users_teams`",
            "DROP TABLE `team`",
            "DROP TABLE `sites`",
            "DROP TABLE `checks`",
            "DROP TABLE `sites_depends`",
            "TRUNCATE TABLE `migrations`"
        );

        return $tables;
    }
}
