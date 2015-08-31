<?php

namespace FOD\Instruct\Event;

use ArrayObject;
use InvalidArgumentException;

class EventNameCollection extends ArrayObject
{
    public function __construct($input = [], $flags = 0, $iteratorClass = 'ArrayIterator')
    {
        array_walk($input, function ($eventName, $index) {
            if (!$eventName instanceof EventName) {
                throw new InvalidArgumentException(
                    "Element $index of the input array is not an instance of FOD\Instruct\Event\Name."
                );
            }
        });

        parent::__construct($input, $flags, $iteratorClass);
    }

    public function contains(EventName $eventName)
    {
        foreach ($this as $innerEventName) {
            if ($innerEventName->isEqualTo($eventName)) {
                return true;
            }
        }

        return false;
    }
}
