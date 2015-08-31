<?php

namespace FOD\Instruct\Event;

use ArrayObject;
use InvalidArgumentException;

class EventCollection extends ArrayObject
{
    public function __construct($input = [], $flags = 0, $iteratorClass = 'ArrayIterator')
    {
        array_walk($input, function ($event, $index) {
            if (!$event instanceof EventInterface) {
                throw new InvalidArgumentException(
                    "Element $index of the input array is not an instance of FOD\Instruct\Event\EventInterface."
                );
            }
        });

        parent::__construct($input, $flags, $iteratorClass);
    }

    public function contains(EventInterface $event)
    {
        foreach ($this as $innerEvent) {
            if ($innerEvent->isEqualTo($event)) {
                return true;
            }
        }

        return false;
    }
}
