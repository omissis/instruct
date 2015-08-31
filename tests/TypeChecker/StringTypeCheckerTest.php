<?php

namespace FOD\Instruct\Tests\TypeChecker;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\TypeChecker\StringTypeChecker;

class StringTypeCheckerTest extends TestCase
{
    public function setUp()
    {
        $this->checker = new StringTypeChecker();
    }

    public function tearDown()
    {
        $this->checker = null;
    }

    public function testCheckPasses()
    {
        $this->assertNull($this->checker->check('foo'));

        $this->assertNull(StringTypeChecker::scheck('foo'));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Bar should be a string. '1' given.
     */
    public function testCheckFails()
    {
        $this->assertNull($this->checker->check(1, 'bar'));

        $this->assertNull(StringTypeChecker::scheck(1, 'bar'));
    }
}
