<?php

namespace FOD\Instruct\Event;

use InvalidArgumentException;

use FOD\Instruct\Event\EventInterface;

final class EventName
{
    private $eventName;

    /**
     * @param string $eventName
     */
    public function __construct($eventName)
    {
        if (!is_string($eventName)) {
            throw new InvalidArgumentException(sprintf(
                "Event name should be a string. '%s' given.",
                var_export($eventName, true)
            ));
        }

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
