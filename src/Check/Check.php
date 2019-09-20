<?php

declare(strict_types=1);

namespace newsworthy39\Check;

//"CREATE TABLE IF NOT EXISTS `checks` (id integer not null primary key auto_increment, sitesid integer not null references sites(id), identifier char(64) not null default '', typeofservice integer not null default 0)",
use newsworthy39\Elegant;
use newsworthy39\Queue;
use newsworthy39\Sites\Site;
use newsworthy39\Check\Command\CheckWorkerCommand;
use newsworthy39\Schedulable;

class Check extends Elegant implements Schedulable
{
    public const TCP = 0;
    public const HTTP = 1;

    public const CHECK_UNKNOWN = -1;
    public const CHECK_OK = 0;
    public const CHECK_WARNING = 1;
    public const CHECK_FAILED = 2;

    protected $tablename = 'checks';

    protected $fields = ['identifier', 'typeofservice', 'created', 'lastupdated'];

    private function __construct()
    { }

    public static function Find($id)
    {
        return self::findModel(self::CreateEmpty(), array('id' => $id));
    }

    public static function FindByIdentifier($identifier)
    {
        return self::findModel(self::CreateEmpty(), array('identifier' => $identifier));
    }

    public static function FindByCompositeIdentifier(Site $site, $checkidentifier)
    {
        $id = $site->id();
        $site = Site::CreateEmpty();
        return self::findModel(self::CreateEmpty(), array('identifier' => $checkidentifier, $site->foreignkey() => $id));
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

    public function getOwner()
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

    public function setLastUpdated($date) {
        $this->lastupdated = $date;
    }

    public function getLastUpdated() {
        return $this->lastupdated;
    }

    public function scheduleCheck() {
        $queue = new Queue;
        $queue->publish(new CheckWorkerCommand($this));
    }

    public function Schedule(Queue $queue) {
        $queue->publish(new CheckWorkerCommand($this));
    }
}
