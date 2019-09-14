<?php
declare(strict_types=1);

use tests\SystemTest;
use newsworthy39\User\User;
use newsworthy39\Check\Check;

class TestUserModel extends SystemTest {

    
    public function testUserCanBeCreated() {
        $user = User::Create('test@virgin.com');
        $this->assertSame($user->email, 'test@virgin.com');
    }

    public function testUserCanBeStored() {
        $user = User::Create('test@virgin.com');
        $user->Store();

        $user2 = User::Find($user->email);
        $this->assertSame($user->email, $user2->email);
    }

    public function testUserCanBeFound() {
        $user = User::Find('test@virgin.com');
        $this->assertSame($user->email, 'test@virgin.com');
    }

    public function testUserCanBeDeleted() {
        $user = User::Find('test@virgin.com');
        $this->assertSame($user->email, 'test@virgin.com');
        $user->Delete();
    }

    public function testUserCanFindChecks() {
        $user = User::Create('test@virgin.com');
        $user->Store();

        $check = Check::Create();
        $check->assignTo($user);
        
        $check->Store();
        $this->assertSame($check->usersid, $user->id);

        $checks = $user->Checks();
        $this->assertSame($checks[0]->identifier, $check->identifier);
    }
}