<?php
declare(strict_types=1);

namespace PHPUnit\Tests\unit;

use PHPUnit\Framework\TestCase;

class HealthCheckTest extends TestCase
{
    public function testHealthCheck()
    {
        self::assertSame(1,1);

    }
    
}