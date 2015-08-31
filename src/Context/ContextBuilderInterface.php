<?php

namespace FOD\Instruct\Context;

use FOD\Instruct\Event\EventInterface;

/**
 * Builder class for instruct' context objects.
 */
interface ContextBuilderInterface
{
    /**
     * Add a new event to this context.
     *
     * @param EventInterface $event
     *
     * @return ContextBuilder
     */
    public function addEvent(EventInterface $event);

    /**
     * Get all added events.
     *
     * @return EventCollection
     */
    public function getEvents();

    /**
     * Creates the context.
     *
     * @return ContextInterface
     */
    public function getContext();
}
