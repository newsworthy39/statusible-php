<?php

declare(strict_types=1);

namespace newsworthy39\Media;


use newsworthy39\Elegant;
use newsworthy39\Schedulable;
use newsworthy39\Queue;
use newsworthy39\Sites\Site;

class Media extends Elegant implements Schedulable
{
    protected $tablename = 'media';
    
    protected $fields = ['identifier'];

    // Prevent construction.
    private function __construct()
    { }

    public static function Find($id)
    {
        return self::findModel(Media::CreateEmpty(), array('id' => $id));
    }

    public static function FindAll()
    {
        return self::findAllModels(Media::CreateEmpty());
    }

    public static function FindByIdentifier($identifier)
    {
        return self::findModel(Media::CreateEmpty(), array('identifier' => $identifier));
    }

    public static function Create(String $identifier, Site $site)
    {
        $instance = new Media();
        $instance->setIdentifier($identifier);
        $instance->assignTo($site);
        return $instance;
    }

    public static function CreateEmpty()
    {
        $instance = new Media();
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
        $result = $this->has($this, $check);
        if ($result) {
            return $result;
        }

        return array();
    }

    public function getScreenShot()
    {
        if (!empty($this->screenshot)) {
            return $this->screenshot;
        } 

        return '/assets/statusible-100x100.png';
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

    public function getCreated()
    {
        $datetime = new \DateTime($this->created);
        return $datetime->format("Y-m-d"); // Updated ISO8601
    }
}
