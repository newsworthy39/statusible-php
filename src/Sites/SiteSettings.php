<?php

declare(strict_types=1);

namespace newsworthy39\Sites;

use newsworthy39\Elegant;

class SiteSettings extends Elegant
{
    protected $tablename = 'sites_settings';

    protected $fields = ['variable', 'data'];

    // Prevent construction.
    private function __construct()
    { }

    public static function Create(Site $site, String $variable)
    {
        $settings = SiteSettings::CreateEmpty();
        $settings->assignTo($site);
        $settings->variable = $variable;
        return $settings;
    }

    public static function CreateEmpty()
    {
        $instance = new SiteSettings();
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

    public function setArray(array $data)
    {
        $this->data = serialize($data);
    }

    public function getAsArray()
    {
        return unserialize($this->data);
    }

    public function set(String $data)
    {
        $this->data = $data;
    }
    public function get()
    {
        return $this->data;
    }
}
