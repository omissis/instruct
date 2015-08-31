<?php

namespace FOD\Instruct\Tests\TypeChecker;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\TypeChecker\IntTypeChecker;

class IntTypeCheckerTest extends TestCase
{
    public function setUp()
    {
        $this->checker = new IntTypeChecker();
    }

    public function tearDown()
    {
        $this->checker = null;
    }

    public function testCheckPasses()
    {
        $this->assertNull($this->checker->check(1));

        $this->assertNull(IntTypeChecker::scheck(1));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Bar should be an int. 'foo' given.
     */
    public function testCheckFails()
    {
        $this->assertNull($this->checker->check('foo', 'bar'));

        $this->assertNull(IntTypeChecker::scheck('foo', 'bar'));
    }
}
