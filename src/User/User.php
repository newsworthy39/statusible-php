<?php

declare(strict_types=1);

namespace newsworthy39\User;

use newsworthy39\Elegant;
use newsworthy39\Sites\Site;

class User extends Elegant
{
    protected $tablename = 'users';

    protected $fields = [
        'email',
        'token',
        'password',
        'tfasalt',
        'nickname',
        'roleid'
    ];

    private function __construct()
    {
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


    public static function FindUsingNickname(String $nickname)
    {
        return self::findModel(new User(), array('nickname' => $nickname));
    }

    public function generateToken()
    {
        $this->token = $this->generateRandomString(64);
    }

    public function setRole(Role $role) {
        $this->roleid = $role->getRoleId();
    }

    public function getRole() : Role {
        return new Role($this->roleid);
    }

    public static function Create(array $arguments): User
    {
        $user =  new User();
        foreach ($arguments as $key => $value) {
            $user->$key = $value;
        }

        return $user;
    }

    public function Store()
    {
        // TODO: Test, the user has a roleid.
        self::createModel($this);
    }

    public function Update()
    {
        // TODO: Test, the user has a roleid.
        self::saveModel($this);
    }

    public function Delete()
    {
        self::deleteModel($this);
    }

    public function Sites()
    {
        return $this->has($this, Site::Create());
    }

    public function Teams()
    { }

    public function Nickname()
    {
        return $this->nickname;
    }

    public function getNotifications()
    {
        // get checks.
        $sites = $this->Sites();
        if ($sites) {
            $notifications = 0;
            foreach ($sites as $site) {
                $notifications += $site->getNotifications();
            }
            return $notifications;
        }

        return 0;
    }

    public function SetPassword(String $password) {
        $this->password = sha1($password);
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
