<?php

declare(strict_types=1);

namespace newsworthy39\User;

use newsworthy39\Elegant;

class User extends Elegant
{
    protected $tablename = 'users';

    protected $fields = [
        'email',
        'token',
        'password'
    ];

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
   
    public static function Find(String $email)
    {
        return self::findModel(new User(), array('email' => $email));
    }

    public static function FindUsingToken(String $token)
    {
        return self::findModel(new User(), array('token' => $token));
    }

    public static function Create(String $email)
    {
        $user =  new User();
        $user->email = $email;
        $user->token = $user->generateRandomString(64);
        return $user;
    }

    public function Store() {
        self::createModel($this);
    }

    public function Update() {
        self::saveModel($this);
    }
}
