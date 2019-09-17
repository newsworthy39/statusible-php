<?php

declare(strict_types=1);

namespace newsworthy39\Sites;

use newsworthy39\Elegant;
use newsworthy39\User\User;

class Site extends Elegant
{
    protected $tablename = 'sites';

    protected $fields = ['identifier'];

    private function __construct() { 
    }

    public static function Create(String $name, User $user) {
        $instance = new Site();
        $instance->setIdentifier($name);
        $instance->assignTo($user);
        return $instance;
    }

    public static function CreateEmpty() {
        $instance = new Site();
        return $instance;
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

    public function getUser() : User
    { 
        $user = User::CreateEmpty();
        return self::findModel($user, array('id' => $this->values[$user->foreignkey()]));
    }
  
    public function getNotifications() {
        return rand(1,100);
    }
    
    public function Status() {
        $colors = [ 'red','green','yellow'];
        return $colors[rand(0,2)];
    }

    public function setIdentifier(String $identifier) {
        $this->identifier = $identifier;
    }

    public function getIdentifier() {
        return $this->identifier;
    }
}
