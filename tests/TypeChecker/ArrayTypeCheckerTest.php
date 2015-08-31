<?php

namespace FOD\Instruct\Tests\TypeChecker;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\TypeChecker\ArrayTypeChecker;

class ArrayTypeCheckerTest extends TestCase
{
    public function testCheckPasses()
    {
        $this->assertNull(ArrayTypeChecker::check([]));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Bar should be an array. ''foo'' given.
     */
    public function testCheckFails()
    {
        $this->assertNull(ArrayTypeChecker::check('foo', 'bar'));
    }
}
