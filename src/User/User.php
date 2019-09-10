<?php declare(strict_types = 1);

namespace newsworthy39\User;
use newsworthy39\Config;

class User {
    
    public $email;
    public $token;
    public $uuid;

    private function __construct(String $mail) {
        $this->email = $mail;
        $this->token = rand( 100, 10000);
        $this->uuid  = sha1($mail);
    }

    public static function create(String $mail) {
        $user = self::load($mail);

        if (!$user) {
            $user = new User($mail);
        }

        return $user;
    }

    public static function load(String $uuid) {
        $app = Config::container();

        // getORMlayer, or fail miserably.
        // $app->get('ORMlayer')
        // Perform get against the ormlayer.

        return false;
        
    }

    public function store() {
    
    }
}