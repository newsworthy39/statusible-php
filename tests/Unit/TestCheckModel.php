<?php

declare(strict_types=1);

use tests\SystemTest;
use newsworthy39\User\User;
use newsworthy39\Check\Check;


class TestCheckModel extends SystemTest
{
    public function testCheckCanBeCreated()
    {
        $check = Check::Create();
        $this->assertNotEmpty($check->identifier);
    }

    public function testCheckCanHaveUsers() {

        
            $user = User::Create('test@virgin.com');
            $user->Store();
    
            $check = Check::Create();
            $check->assignTo($user);
            
            $check->Store();
            $this->assertSame($check->usersid, $user->id);
    
            $founduser = $check->User();
            $this->assertSame($user->email, $founduser->email);
        
    }

    public function testCheckCanDeliverNotifications() {
        $check = Check::Create();
        $this->assertNotEmpty($check->getNotifications());
    }
}
