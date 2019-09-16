<?php

declare(strict_types=1);

namespace newsworthy39\User;



class Role
{
    private $roleid;

    const OWNER = 0;
    const ADMINISTRATOR = 1;

    public function __construct($constant)
    {
        $this->roleid = $constant;
    }

    public function getRoleId()
    {
        return $this->roleid;
    }
}
