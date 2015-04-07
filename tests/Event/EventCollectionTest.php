<?php

namespace FOD\Instruct\Tests\Event;

use PHPUnit_Framework_TestCase as TestCase;

use stdClass;

use FOD\Instruct\Event\EventCollection;

class EventCollectionTest extends TestCase
{
    public function testEmptyInstatiation()
    {
        $events = new EventCollection([]);

        $this->assertInstanceOf('FOD\Instruct\Event\EventCollection', $events);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Element 1 of the input array is not an instance of FOD\Instruct\Event\EventInterface.
     */
    public function testWrongTypeInstatiation()
    {
        $event = $this->prophesize('FOD\Instruct\Event\EventInterface');

        new EventCollection([$event->reveal(), new stdClass()]);
    }
}
