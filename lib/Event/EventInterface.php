<?php

namespace FOD\Instruct\Event;

interface EventInterface
{
    /**
     * @return ArrayObject
     */
    public function getData();

    /**
     * @param EventInterface $event
     *
     * @return boolean
     */
    public function isEqualTo(EventInterface $event);
}
