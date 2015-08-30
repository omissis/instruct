<?php

namespace FOD\Instruct\Tests\Event;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\Event\EventName;

class EventNameTest extends TestCase
{
    const TEST_EVENT_NAME = 'foo:bar';

    public function testEmptyInstatiation()
    {
        $eventName = new EventName(self::TEST_EVENT_NAME);

        $this->assertInstanceOf('FOD\Instruct\Event\EventName', $eventName);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Event name should be a string. 'array (
     * )' given.
     */
    public function testWrongTypeInstatiation()
    {
        $eventName = new EventName([]);
    }

    public function testCanBeConvertedToString()
    {
        $eventName = new EventName(self::TEST_EVENT_NAME);

        $this->assertSame(self::TEST_EVENT_NAME, (string)$eventName);
    }

    /**
     * @dataProvider eventNamesProvider
     */
    public function testComparison($expectedEquality, $name1, $name2)
    {
        $this->assertSame($expectedEquality, (new EventName($name1))->isEqualTo(new EventName($name2)));
    }

    public function eventNamesProvider()
    {
        return [
            [ true,  self::TEST_EVENT_NAME, self::TEST_EVENT_NAME ],
            [ false, self::TEST_EVENT_NAME, self::TEST_EVENT_NAME . ':baz' ],
        ];
    }

    public function testMatchesEventByName()
    {
        $event = $this->prophesize('FOD\Instruct\Event\EventInterface');

        $event->getName()->willReturn(new EventName(self::TEST_EVENT_NAME));

        $eventName = new EventName(self::TEST_EVENT_NAME);

        $this->assertTrue($eventName->matches($event->reveal()));
    }
}
