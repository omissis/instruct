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

    public function testContainsEvents()
    {
        $event1 = $this->prophesize('FOD\Instruct\Event\EventInterface');
        $event2 = $this->prophesize('FOD\Instruct\Event\EventInterface');

        $event1->isEqualTo($event1->reveal())->willReturn(true)->shouldBeCalledTimes(1);
        $event1->isEqualTo($event2->reveal())->willReturn(false)->shouldBeCalledTimes(1);

        $events = new EventCollection([$event1->reveal()]);

        $this->assertTrue($events->contains($event1->reveal()));
        $this->assertFalse($events->contains($event2->reveal()));
    }
}
