<?php
declare(strict_types=1);

use tests\SystemTest;
use newsworthy39\User\User;
use newsworthy39\User\Role;
use newsworthy39\Sites\Site;

class TestUserModel extends SystemTest {

    
    public function testUserCanBeCreated() {
        $role = new Role(Role::OWNER);
        $user = User::Create([ 'email' => 'test@virgin.com' , 'nickname' => 'test']);
        $user->setRole($role);
        $this->assertSame($user->email, 'test@virgin.com');
    }

    public function testUserCanBeStored() {
        $role = new Role(Role::OWNER);
        $user = User::Create([ 'email' => 'test@virgin.com' , 'nickname' => 'test']);
        $user->setRole($role);
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
        $role = new Role(Role::OWNER);
        $user = User::Create([ 'email' => 'test@virgin.com' , 'nickname' => 'test']);
        $user->setRole($role);
        $user->Store();

        $check = Site::Create();
        $check->assignTo($user);
        
        $check->Store();
        $this->assertSame($check->usersid, $user->id);

        $checks = $user->Sites();
        $this->assertSame($checks[0]->identifier, $check->identifier);
    }
}