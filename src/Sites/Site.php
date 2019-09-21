<?php

declare(strict_types=1);

namespace newsworthy39\Sites;

use newsworthy39\Check\Check;
use newsworthy39\Elegant;
use newsworthy39\User\User;
use newsworthy39\Schedulable;
use newsworthy39\Queue;

class Site extends Elegant implements Schedulable
{
    protected $tablename = 'sites';

    protected $fields = ['identifier'];

    // Prevent construction.
    private function __construct()
    { }

    public static function Find($id)
    {
        return self::findModel(Site::CreateEmpty(), array('id' => $id));
    }

    public static function FindAll()
    {
        return self::findModels(Site::CreateEmpty());
    }

    public static function FindByIdentifier($identifier)
    {
        return self::findModel(Site::CreateEmpty(), array('identifier' => $identifier));
    }

    public static function Create(String $identifier, User $user)
    {
        $instance = new Site();
        $instance->setIdentifier($identifier);
        $instance->assignTo($user);
        return $instance;
    }

    public static function CreateEmpty()
    {
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

    public function getOwner(): User
    {
        $user = User::CreateEmpty();
        return self::findModel($user, array('id' => $this->values[$user->foreignkey()]));
    }

    public function getNotifications()
    {
        return rand(1, 100);
    }

    public function setIdentifier(String $identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getServiceStatus()
    {
        $status = 0;
        $checks = $this->Checks();
        if (is_array($checks)) {
            foreach ($checks as $check) {
                $highestStatus = $check->getStatus();
                if ($highestStatus > $status) {
                    $status = $highestStatus;
                }
            }
        }
        return $status;
    }

    public function Checks()
    {
        $check = Check::CreateEmpty();
        return $this->has($this, $check);
    }

    public function Schedule(Queue $user)
    {
        // This allows us, to skip-checks 
        // and do time-keeping at a more granular level.
        $checks = $this->Checks();
        if (is_array($checks)) {
            foreach ($checks as $check) {
                if ($check->getTypeOfCheck() == Check::CHECK_ACTIVE) {
                    $check->Schedule($user);
                }
            }
        }
    }
}
