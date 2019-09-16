<?php

declare(strict_types=1);

use tests\SystemTest;
use newsworthy39\User\User;
use newsworthy39\Sites\Site;


class TestSitesModel extends SystemTest
{
    public function testCheckCanBeCreated()
    {
        $check = Site::Create();
        $this->assertNotEmpty($check->identifier);
    }

    public function testSiteBelongsToAUser() {

        
            $user = User::Create([ 'email' => 'test@virgin.com' , 'nickname' => 'test']);
            $user->Store();
    
            $Site = Site::Create();
            $Site->assignTo($user);
            
            $Site->Store();
            $this->assertSame($Site->usersid, $user->id);
    
            $founduser = $Site->User();
            $this->assertSame($user->email, $founduser->email);
        
    }

    public function testCheckCanDeliverNotifications() {
        $site = Site::Create();
        $this->assertNotEmpty($site->getNotifications());
    }

    public function testCheckHasStatus() {
        $site = Site::Create();
        $this->assertNotEmpty($site->Status());
    }
}
