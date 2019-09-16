<?php
declare(strict_types=1);

use tests\SystemTest;
use newsworthy39\User\User;
use newsworthy39\Check\Check;
use newsworthy39\Sites\Site;

class TestUserModel extends SystemTest {

    
    public function testUserCanBeCreated() {
        $user = User::Create([ 'email' => 'test@virgin.com' , 'nickname' => 'test']);
        $this->assertSame($user->email, 'test@virgin.com');
    }

    public function testUserCanBeStored() {
        $user = User::Create([ 'email' => 'test@virgin.com' , 'nickname' => 'test']);
        $user->Store();

        $user2 = User::Find($user->email);
        $this->assertSame($user->email, $user2->email);
    }

    public function testUserCanBeFound() {
        $user = User::Find('test@virgin.com');
        $this->assertSame($user->email, 'test@virgin.com');
    }

    public function testUsersNicknameWorks() {
        $user = User::Find('test@virgin.com');
        $this->assertSame($user->nickname, 'test');
        $this->assertSame($user->Nickname(), 'test');
    }

    public function testUsersNotificationsWorks() {
        $user = User::Find('test@virgin.com');
        $this->assertIsNumeric($user->getNotifications());
    }

    public function testUserCanBeDeleted() {
        $user = User::Find('test@virgin.com');
        $this->assertSame($user->email, 'test@virgin.com');
        $user->Delete();
    }

    public function testUserCanFindSites() {
        $user = User::Create([ 'email' => 'test@virgin.com' , 'nickname' => 'test']);
        $user->Store();

        $check = Site::Create();
        $check->assignTo($user);
        
        $check->Store();
        $this->assertSame($check->usersid, $user->id);

        $checks = $user->Sites();
        $this->assertSame($checks[0]->identifier, $check->identifier);
    }
}