<?php

declare(strict_types=1);

use tests\SystemTest;
use newsworthy39\User\User;
use newsworthy39\Sites\Site;
use newsworthy39\Check\Check;
use newsworthy39\Media\Media;

class TestMediaModel extends SystemTest
{
    public function testMediaCanBeCreated()
    {
        $user = User::Create('test@virgin.com','test-virgon');
        $user->Store();

        $site = Site::Create("Test", $user);
        $site->Store();

        $media = Media::Create('test-image-240', $site); 
        $media->Store();

        $this->assertIsNumeric($media->id);
    }   
}
