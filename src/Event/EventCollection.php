<?php

namespace FOD\Instruct\Event;

use FOD\Instruct\Collection\TypeCollection;

class EventCollection extends TypeCollection
{
    public function __construct(array $input = [])
    {
        parent::__construct($input, 'FOD\Instruct\Event\EventInterface');
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
