<?php

declare(strict_types=1);

namespace newsworthy39;

use newsworthy39\Elegant;

class Settings extends Elegant
{
    protected $tablename = 'settings';

    protected $fields = [
        'signupEnabled',
    ];

    private function __construct()
    {
        
    }

    public static function Load(): Settings
    {
        $settings =  new Settings();
        return $settings;
    }

    public static function CreateEmpty(): Settings
    {
        $settings =  new Settings();
        return $settings;
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

    public function getId()
    {
        return $this->id();
    }

}
