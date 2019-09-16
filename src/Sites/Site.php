<?php

declare(strict_types=1);

namespace newsworthy39\Sites;

use newsworthy39\Elegant;
use newsworthy39\User\User;

class Site extends Elegant
{
    protected $tablename = 'sites';

    protected $fields = ['identifier'];

    private function __construct()
    { }

    public static function Create(): Site
    {
        $site =  new Site();
        $site->generateIdentifier();
        return $site;
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
        $user = User::Create([]);
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
    
    public function Status() {
        $colors = [ 'red','green','yellow'];
        return $colors[rand(0,2)];
    }
}
