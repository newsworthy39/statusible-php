<?php

declare(strict_types=1);

namespace newsworthy39\User;

use newsworthy39\Elegant;

class User extends Elegant
{
    protected $tablename = 'checks';

    protected $fields = [];

    private function __construct()
    { }


    public static function Create()
    {
        return new Check();
    }

    public function Store()
    {
        self::createModel($this);
    }

    public function Update()
    {
        self::saveModel($this);
    }

    public function Delete()
    {
        self::deleteModel($this);
    }

    public function User()
    { }

    
}
