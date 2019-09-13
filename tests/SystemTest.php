<?php
declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;

class SystemTest extends TestCase {

    protected static $tinker;

    public static function setUpBeforeClass(): void
    {
        self::$tinker = app()->get(\newsworthy39\Factory\Tinker::class);
        
        self::$tinker->up();
    }

    public static function tearDownAfterClass(): void
    {
        self::$tinker->down();        
    }
}