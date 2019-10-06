<?php

declare(strict_types=1);

use tests\SystemTest;
use newsworthy39\User\User;
use newsworthy39\Sites\Site;
use newsworthy39\Sites\SiteSettings;
use newsworthy39\User\Role;

class TestSitesModel extends SystemTest
{
    public function testSiteCanBeCreated()
    {
        $user = User::Create('test@virgin.com','test-virgon');
        $user->Store();

        $site = Site::Create("Test", $user);
        $site->Store();

        $this->assertNotEmpty($site->getIdentifier());
    }

    public function testSiteBelongsToAUser()
    {
        $user = User::Create('test@virgin.com','test-virgon');
        $user->Store();

        $site = Site::Create("Test", $user);
        $site->Store();
        $this->assertSame($site->getOwner()->getId(), $user->getId());

        $founduser = $site->getOwner();
        $this->assertSame($user->getEmail(), $founduser->getEmail());
    }

    public function testSiteCanDeliverNotifications()
    {
        $user = User::Create('test@virgin.com','test-virgon');
        $user->Store();

        $site = Site::Create("Test", $user);
        $site->Store();
        $this->assertNotEmpty($site->getNotifications());
        $site->Delete();

    }

    public function testSiteHasStatus()
    {
        $user = User::Create('test@virgin.com','test-virgon');
        $user->Store();

        $site = Site::Create("Test", $user);
        $site->Store();
        $this->assertIsNumeric($site->getServiceStatus());
    }

    public function testSiteHasSettings() {
        $user = User::Create('test@virgin.com','test-virgon');
        $user->Store();

        $site = Site::Create("Test", $user);
        $site->Store();

        $setting = SiteSettings::Create($site, 'testvar');
        $setting->setArray(array('var' => 'test'));
        $setting->Store();
        
        $settings = $site->settings();
        $this->assertIsArray($settings);

    }
}
