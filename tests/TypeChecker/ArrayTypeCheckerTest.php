<?php

namespace FOD\Instruct\Tests\TypeChecker;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\TypeChecker\ArrayTypeChecker;

class ArrayTypeCheckerTest extends TestCase
{
    public function setUp()
    {
        $this->checker = new ArrayTypeChecker();
    }

    public function tearDown()
    {
        $this->checker = null;
    }

    public function testCheckPasses()
    {
        $this->assertNull($this->checker->check([]));

        $this->assertNull(ArrayTypeChecker::scheck([]));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Bar should be an array. 'foo' given.
     */
    public function testCheckFails()
    {
        $this->assertNull($this->checker->check('foo', 'bar'));

        $this->assertNull(ArrayTypeChecker::scheck('foo', 'bar'));
    }
}
