<?php

namespace FOD\Instruct\Comparator;

use InvalidArgumentException;

class IsEqualToComparator implements ComparatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function compare($firstItem, $secondItem)
    {
        if (!is_object($secondItem)) {
            throw new InvalidArgumentException(
                'The second item is expected to be an object and to implement isEqualTo() method.'
            );
        }

        if (!method_exists($secondItem, 'isEqualTo')) {
            throw new InvalidArgumentException(
                'The second item is expected to implement isEqualTo() method.'
            );
        }

        return $secondItem->isEqualTo($firstItem);
    }
}
