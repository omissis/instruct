<?php

namespace FOD\Instruct\Event;

use FOD\Instruct\Collection\TypeCollection;
use FOD\Instruct\Comparator\IsEqualToComparator;

class EventCollection extends TypeCollection
{
    public function __construct(array $input = [])
    {
        parent::__construct($input, 'FOD\Instruct\Event\EventInterface', new IsEqualToComparator());
    }
}
