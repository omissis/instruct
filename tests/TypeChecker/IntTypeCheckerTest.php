<?php

namespace FOD\Instruct\Tests\TypeChecker;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\TypeChecker\IntTypeChecker;

class IntTypeCheckerTest extends TestCase
{
    public function testCheckPasses()
    {
        $this->assertNull(IntTypeChecker::check(1));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Bar should be an integer. ''foo'' given.
     */
    public function testCheckFails()
    {
        $this->assertNull(IntTypeChecker::check('foo', 'bar'));
    }
}
