<?php

declare(strict_types=1);

namespace newsworthy39\Check;

//"CREATE TABLE IF NOT EXISTS `checks` (id integer not null primary key auto_increment, sitesid integer not null references sites(id), identifier char(64) not null default '', typeofservice integer not null default 0)",

use newsworthy39\Elegant;
use newsworthy39\Sites\Site;

class Check extends Elegant
{
    public const TCP = 0;
    public const HTTP = 1;

    public const CHECK_UNKNOWN = -1;
    public const CHECK_OK = 0;
    public const CHECK_WARNING = 1;
    public const CHECK_FAILED = 2;
    

    protected $tablename = 'checks';

    protected $fields = ['identifier', 'typeofservice', 'created'];

    private function __construct()
    { }

    public static function Find($id)
    {
        return self::findModel(Site::CreateEmpty(), array('id' => $id));
    }

    public static function FindByIdentifier($identifier)
    {
        return self::findModel(Site::CreateEmpty(), array('identifier' => $identifier));
    }

    public static function Create(String $identifier, Site $site, $typeofservice)
    {
        $instance = new Check();
        $instance->setIdentifier($identifier);
        $instance->assignTo($site);
        $instance->setTypeOfService($typeofservice);
        return $instance;
    }

    
    public static function CreateEmpty() {
        $instance = new Check();
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

    public function getOwner() : User
    { 
        $user = User::CreateEmpty();
        return self::findModel($user, array('id' => $this->values[$user->foreignkey()]));
    }

    public function setTypeOfService($integer)
    {
        $this->typeofservice = $integer;
    }

    public function getTypeOfService()
    {
        return $this->typeofservice;
    }

    public function getTypeOfServiceHumanReadable() {
        if ($this->typeofservice == self::TCP ) return "TCP";
        if ($this->typeofservice == self::HTTP ) return "HTTP";
    }

    public function setIdentifier(String $identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getSupportedServices() {
        return ['TCP','HTTP'];
    }

    public static function fromString(String $typeofservice) {
        if ($typeofservice == 'TCP' ) return self::TCP;
        if ($typeofservice == 'HTTP' ) return self::HTTP;
    }

    public function getCreated() {
        return $this->created;
    }

    public function getStatus(){
        return 0;
    }
}
