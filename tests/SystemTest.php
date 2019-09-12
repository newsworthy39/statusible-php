<?php
declare(strict_types=1);

namespace tests;

use newsworthy39\Factory\Tinker;
use PHPUnit\Framework\TestCase;

class SystemTest extends TestCase {

    protected static $tinker;

    public static function setUpBeforeClass(): void
    {
        self::$tinker = new Tinker;
        self::$tinker->up();
    }

    public static function tearDownAfterClass(): void
    {
        self::$tinker->down();        
    }
}