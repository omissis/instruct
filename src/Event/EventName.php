<?php

namespace FOD\Instruct\Event;

use FOD\Instruct\TypeChecker\StringTypeChecker;

final class EventName
{
    private $eventName;

    /**
     * @param string $eventName
     */
    public function __construct($eventName)
    {
        StringTypeChecker::scheck($eventName, 'Event name');

        $this->eventName = $eventName;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->eventName;
    }

    /**
     * @return bool
     */
    public function isEqualTo(EventName $name)
    {
        return (string)$this === (string)$name;
    }

    /**
     * @return bool
     */
    public function matches(EventInterface $event)
    {
        return (string)$this === (string)$event->getName();
    }
}
