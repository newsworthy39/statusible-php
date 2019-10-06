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
    ];

    private function __construct()
    {
        $this->generateToken();
    }

    public static function Find(String $email)
    {
        return self::findModel(User::CreateEmpty(), array('email' => $email));
    }

    public static function FindUsingToken(String $token)
    {
        return self::findModel(User::CreateEmpty(), array('token' => $token));
    }


    public static function FindUsingNickname(String $nickname)
    {
        return self::findModel(User::CreateEmpty(), array('nickname' => $nickname));
    }

    public function generateToken()
    {
        $this->token = $this->generateRandomString(64);
    }

    public static function Create(String $email, String $nickname): User
    {
        $user =  new User();
        $user->setEmail($email);
        $user->setNickname($nickname);
        return $user;
    }

    public static function CreateEmpty(): User
    {
        $user =  new User();
        return $user;
    }

    public function setEmail(String $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setNickname(String $nickname)
    {
        $this->nickname = $nickname;
    }

    public function getId()
    {
        return $this->id();
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
        return $this->has($this, Site::CreateEmpty());
    }

    public function Teams()
    { }

    public function getIdentifier()
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

    public function setPassword(String $password)
    {
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

    public function getCreated()
    {
        $datetime = new \DateTime($this->created);
        return $datetime->format("Y-m-d"); // Updated ISO8601

    }

    public function getAvatar($size=80)
    {
        return $this->get_gravatar($this->getEmail(), $size);
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    private function get_gravatar($email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array())
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
}
