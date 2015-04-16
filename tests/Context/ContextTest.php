<?php

namespace FOD\Instruct\Tests\Context;

use FOD\Instruct\Context\Context;
use PHPUnit_Framework_TestCase as TestCase;

class ContextTest extends TestCase
{
    public function setUp()
    {
        $this->context = new Context(['foo' => 'bar']);
    }

    public function tearDown()
    {
        $this->context = null;
    }

    public function testReturnsData()
    {
        $this->assertSame('bar', $this->context->get('foo'));

        $this->assertSame('quux', $this->context->get('baz', 'quux'));
    }
}
