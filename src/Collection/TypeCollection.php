<?php

namespace FOD\Instruct\Collection;

use ArrayObject;
use InvalidArgumentException;

/**
 * A TypeCollection is an ArrayObject that accepts only objects of a single type.
 */
class TypeCollection extends ArrayObject
{
    public function __construct(array $input = [], $type = 'string')
    {
        foreach ($input as $index => $value) {
            $valueType = gettype($value);

            if ('object' === $valueType) {
                if (!$value instanceof $type) {
                    throw new InvalidArgumentException(sprintf(
                        'Element %d of the input array is not an instance of %s. %s given.',
                        $index,
                        $type,
                        get_class($value)
                    ));
                }

                continue;
            }

            if ($type !== $valueType) {
                throw new InvalidArgumentException(sprintf(
                    'Element %d of the input array is not a %s. %s given.',
                    $index,
                    $type,
                    $valueType
                ));
            }
        }

        parent::__construct($input, 0, 'ArrayIterator');
    }
}
