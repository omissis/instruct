<?php

namespace FOD\Instruct\Context;

use FOD\Instruct\Event\EventCollection;
use FOD\Instruct\Event\EventInterface;
use BadMethodCallException;

final class ContextBuilder implements ContextBuilderInterface
{
    /**
     * @var bool
     */
    private $locked = false;

    /**
     * @var EventCollection
     */
    private $events;

    public function __construct()
    {
        $this->events = new EventCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function addEvent(EventInterface $event)
    {
        $this->events->append($event);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * {@inheritdoc}
     */
    public function getContext()
    {
        if ($this->locked) {
            throw new BadMethodCallException('Cannot call getContext() twice on the same instance.');
        }

        $this->locked = true;

        $data = [];
        foreach ($this->events as $event) {
            $data = array_merge($data, $event->getData());
        }

        return new Context($data);
    }
}
