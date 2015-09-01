<?php

namespace FOD\Instruct\Tests\Event;

use PHPUnit_Framework_TestCase as TestCase;

use stdClass;

use FOD\Instruct\Event\EventNameCollection;
use FOD\Instruct\Event\EventName;

class EventNameCollectionTest extends TestCase
{
    public function testEmptyInstatiation()
    {
        $eventNames = new EventNameCollection([]);

        $this->assertInstanceOf('FOD\Instruct\Event\EventNameCollection', $eventNames);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Element 1 of the input array is not an instance of FOD\Instruct\Event\EventName.
     */
    public function testWrongTypeInstatiation()
    {
        new EventNameCollection([new EventName('foo'), new stdClass()]);
    }

    public function testContainsEvents()
    {
        $eventName1 = new EventName('foo');
        $eventName2 = new EventName('bar');

        $events = new EventNameCollection([$eventName1]);

        $this->assertTrue($events->contains($eventName1));
        $this->assertFalse($events->contains($eventName2));
    }
}
