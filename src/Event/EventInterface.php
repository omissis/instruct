<?php

namespace FOD\Instruct\Event;

interface EventInterface
{
    /**
     * @return Event\Name
     */
    public function getName();

    /**
     * @return ArrayObject
     */
    public function getData();

    /**
     * @param EventInterface $event
     *
     * @return bool
     */
    public function isEqualTo(EventInterface $event);
}
