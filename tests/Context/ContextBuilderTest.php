<?php

namespace FOD\Instruct\Tests\Context;

use FOD\Instruct\Context\ContextBuilder;
use PHPUnit_Framework_TestCase as TestCase;

class ContextBuilderTest extends TestCase
{
    public function setUp()
    {
        $this->builder = new ContextBuilder();
    }

    public function tearDown()
    {
        $this->builder = null;
    }

    public function testInstantiation()
    {
        $this->assertInstanceOf('FOD\Instruct\Context\ContextBuilder', $this->builder);
    }

    public function testAddEventIsFluent()
    {
        $event = $this->prophesize('FOD\Instruct\Event\EventInterface');
        $anotherEvent = $this->prophesize('FOD\Instruct\Event\EventInterface');

        $this->assertInstanceOf('FOD\Instruct\Context\ContextBuilder', $this->builder->addEvent($event->reveal()));
        $this->assertInstanceOf('FOD\Instruct\Context\ContextBuilder', $this->builder->addEvent($anotherEvent->reveal()));
    }

    public function testAddEvent()
    {
        $event = $this->prophesize('FOD\Instruct\Event\EventInterface');

        $this->builder->addEvent($event->reveal())->addEvent($event->reveal());

        $this->assertCount(2, $this->builder->getEvents());
        $this->assertInstanceOf('FOD\Instruct\Event\EventCollection', $this->builder->getEvents());
    }

    public function testReturnContext()
    {
        $this->assertInstanceOf('FOD\Instruct\Context\ContextInterface', $this->builder->getContext());
    }

    public function testReturnedContextContainsEventData()
    {
        $event = $this->prophesize('FOD\Instruct\Event\EventInterface');
        $event->getData()->willReturn(['foo' => 'bar'])->shouldBeCalledTimes(1);

        $anotherEvent = $this->prophesize('FOD\Instruct\Event\EventInterface');
        $anotherEvent->getData()->willReturn(['baz' => 'qux'])->shouldBeCalledTimes(1);

        $this->assertInstanceOf('FOD\Instruct\Context\ContextBuilder', $this->builder->addEvent($event->reveal()));
        $this->assertInstanceOf('FOD\Instruct\Context\ContextBuilder', $this->builder->addEvent($anotherEvent->reveal()));

        $context = $this->builder->getContext();

        $this->assertSame('bar', $context->get('foo'));
        $this->assertSame('qux', $context->get('baz'));
    }

    /**
     * @expectedException BadMethodCallException
     * @expectedExceptionMessage Cannot call getContext() twice on the same instance.
     */
    public function testIsLockedAfterGettingContext()
    {
        $this->builder->getContext();
        $this->builder->getContext();
    }
}
