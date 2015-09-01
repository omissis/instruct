<?php

namespace FOD\Instruct\Comparator;

class IdentityComparator implements ComparatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function compare($firstItem, $secondItem)
    {
        return $firstItem === $secondItem;
    }
}
