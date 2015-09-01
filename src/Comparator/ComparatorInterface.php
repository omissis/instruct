<?php

namespace FOD\Instruct\Comparator;

interface ComparatorInterface
{
    /**
     * @param mixed $firstItem
     * @param mixed $firstItem
     *
     * @return bool
     */
    public function compare($firstItem, $secondItem);
}
