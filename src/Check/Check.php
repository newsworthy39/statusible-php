<?php

declare(strict_types=1);

namespace newsworthy39\Check;

use newsworthy39\Elegant;
use newsworthy39\User\User;

class Check extends Elegant
{
    protected $tablename = 'checks';

    protected $fields = ['identifier'];

    private function __construct()
    { }

    public static function Create(): Check
    {
        $check =  new Check();
        $check->generateIdentifier();
        return $check;
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
    { 
        $user = User::Create(array('email' => 'test@virgon.com','nickname' => 'test'));
        return self::findModel($user, array('id' => $this->values[$user->foreignkey()]));
    }

    public function getNotifications() {
        return rand(1,100);
    }
    
    public function generateIdentifier()
    {
        $this->identifier = $this->generateRandomString(64);
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
