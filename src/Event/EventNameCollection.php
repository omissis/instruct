<?php

namespace FOD\Instruct\Event;

use FOD\Instruct\Collection\TypeCollection;

class EventNameCollection extends TypeCollection
{
    public function __construct(array $input = [])
    {
        parent::__construct($input, 'FOD\Instruct\Event\EventName');
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
