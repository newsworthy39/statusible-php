<?php

declare(strict_types=1);

use newsworthy39\Search\Search;
use tests\SystemTest;


class TestSearchSystem extends SystemTest
{
    public function testUserCanSearch()
    {
        $search = array('identifier' => 'test');
        $result = Search::Find($search);
        $this->assertIsArray($result);
    }

}
