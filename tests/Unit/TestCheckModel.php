<?php

declare(strict_types=1);

use tests\SystemTest;
use newsworthy39\User\User;
use newsworthy39\Sites\Site;
use newsworthy39\Check\Check;

class TestCheckModel extends SystemTest
{
    public function testSiteCanBeCreated()
    {
        $user = User::Create('test@virgin.com','test-virgon');
        $user->Store();

        $site = Site::Create("Test", $user);
        $site->Store();

        $check = Check::Create("Test", $site, Check::TCP, '127.0.0.1');
        $check->Store();

        $this->assertNotEmpty($site->getIdentifier());
    }

    public function testSiteCanBeFound()
    {
        $user = User::Create('test@virgin.com','test-virgon');
        $user->Store();

        $site = Site::Create("Test", $user);
        $site->Store();

        $check = Check::Create("Test", $site, Check::TCP, '127.0.0.1');
        $check->Store();

        $this->assertNotEmpty($site->getIdentifier());

        $checks = $site->Checks();
        $this->assertNotEmpty($checks);
    }
}
