<?php

namespace App\Tests\Util;

use PHPUnit\Framework\TestCase;

class DumbTest extends TestCase
{
    public function testEquals()
    {
        $this->assertEquals(42, 42);
    }
}