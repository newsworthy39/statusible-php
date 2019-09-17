<?php
declare(strict_types=1);

use tests\SystemTest;
use newsworthy39\User\User;
use newsworthy39\User\Role;
use newsworthy39\Sites\Site;

class TestUserModel extends SystemTest {

    
    public function testUserCanBeCreated() {

        $user = User::Create('test@virgin.com','test-virgon');

        $this->assertSame($user->email, 'test@virgin.com');
    }

    public function testUserCanBeStored() {

        $user = User::Create('test@virgin.com','test-virgon');
        $user->Store();

        $user2 = User::Find($user->email);
        $this->assertSame($user->email, $user2->email);
    }

    public function testUserCanBeFound() {
        $user = User::Find('test@virgin.com');
        $this->assertSame($user->getEmail(), 'test@virgin.com');
    }

    public function testUsersNicknameWorks() {
        $user = User::Find('test@virgin.com');
        $this->assertSame($user->getNickname(), 'test-virgon');
    }

    public function testUsersNotificationsWorks() {
        $user = User::Find('test@virgin.com');
        $this->assertIsNumeric($user->getNotifications());
    }

    public function testUserCanBeDeleted() {
        $user = User::Find('test@virgin.com');
        $this->assertSame($user->getEmail(), 'test@virgin.com');
        $user->Delete();
    }

    public function testUserCanFindSites() {
        $user = User::Create('test@virgin.com','test-virgon');
        $user->Store();

        $check = Site::Create('https://www.bt.dk', $user);
        $check->Store();
        $this->assertSame($check->getUser()->getId(), $user->getId());

        //$checks = $user->Sites();
        //$this->assertSame($checks[0]->identifier, $check->identifier);
    }
}