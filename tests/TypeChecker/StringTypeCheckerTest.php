<?php

namespace FOD\Instruct\Tests\TypeChecker;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\TypeChecker\StringTypeChecker;

class StringTypeCheckerTest extends TestCase
{
    public function testCheckPasses()
    {
        $this->assertNull(StringTypeChecker::check('foo'));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Bar should be a string. '1' given.
     */
    public function testCheckFails()
    {
        $this->assertNull(StringTypeChecker::check(1, 'bar'));
    }
}
