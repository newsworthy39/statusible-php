<?php

declare(strict_types=1);

namespace newsworthy39\User;

use newsworthy39\Elegant;
use newsworthy39\Check\Check;

class User extends Elegant
{
    protected $tablename = 'users';

    protected $fields = [
        'email',
        'token',
        'password',
        'tfasalt',
        'nickname'
    ];

    private function __construct() {
        $this->generateToken();
    }   
   
    public static function Find(String $email)
    {
        return self::findModel(new User(), array('email' => $email));
    }

    public static function FindUsingToken(String $token)
    {
        return self::findModel(new User(), array('token' => $token));
    }

    public function generateToken() {
        $this->token = $this->generateRandomString(64);
    }

    public static function Create(Array $arguments) : User
    {
        $user =  new User();
        foreach($arguments as $key=>$value) {
            $user->$key = $value;
        }

        return $user;
    }

    public function Store() {
        self::createModel($this);
    }

    public function Update() {
        self::saveModel($this);
    }

    public function Delete() {
        self::deleteModel($this);
    }

    public function Checks()  {
        return $this->has($this, Check::Create());      
    }

    public function Teams() {

    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
