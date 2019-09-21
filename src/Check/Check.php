<?php

declare(strict_types=1);

namespace newsworthy39\Check;

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

    public const CHECK_ACTIVE = 0;
    public const CHECK_PASSIVE = 1;


    protected $tablename = 'checks';

    protected $fields = ['identifier', 'typeofservice', 'created', 'lastupdated', 'endpoint', 'activecheck', 'enabled'];

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

    public static function Create(String $identifier, Site $site, $typeofservice, String $endpoint)
    {
        $instance = new Check();
        $instance->setIdentifier($identifier);
        $instance->assignTo($site);
        $instance->setTypeOfService($typeofservice);
        $instance->setEndpoint($endpoint);
        return $instance;
    }

    public static function CreateEmpty()
    {
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

    public function getTypeOfServiceHumanReadable()
    {
        if ($this->typeofservice == self::TCP) return "TCP";
        if ($this->typeofservice == self::HTTP) return "HTTP";
    }

    public function setIdentifier(String $identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getSupportedServices()
    {
        return ['HTTP', 'HTTPS', 'TCP'];
    }

    public static function fromString(String $typeofservice)
    {
        if ($typeofservice == 'TCP') return self::TCP;
        if ($typeofservice == 'HTTP') return self::HTTP;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getStatus()
    {
        return 0;
    }

    public function setLastUpdated($date)
    {
        $this->lastupdated = $date;
    }

    public function getLastUpdated()
    {
        return $this->lastupdated;
    }


    public function getTypeOfCheck()
    {
        return $this->activecheck;
    }

    public function getSupportedTypeOfChecks()
    {
        return ['Active', 'Passive'];
    }

    public function getSupportedCheckInterval()
    {
        return ['Adaptive', 'Minute', 'Hourly', 'Daily', 'Monthly'];
    }

    public function getEndpoint(): String
    {
        return $this->endpoint;
    }

    public function setEndpoint(String $endpoint)
    {
        $this->endpoint = $endpoint;
    }


    // functions related, to commands and scheduler.
    public function scheduleCheck()
    {
        $queue = new Queue;
        $queue->publish(new CheckWorkerCommand($this));
    }

    public function Schedule(Queue $queue)
    {
        $queue->publish(new CheckWorkerCommand($this));
    }
}
