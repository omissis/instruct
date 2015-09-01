<?php

namespace FOD\Instruct\Collection;

use ArrayObject;
use InvalidArgumentException;

use FOD\Instruct\Comparator\IdentityComparator;
use FOD\Instruct\Comparator\ComparatorInterface;

/**
 * A TypeCollection is an ArrayObject that accepts only objects of a single type.
 */
class TypeCollection extends ArrayObject
{
    public function __construct(array $input = [], $type = 'string', ComparatorInterface $itemsComparator = null)
    {
        foreach ($input as $index => $value) {
            $valueType = gettype($value);

            if ('object' === $valueType) {
                $this->checkIsObjectOfInstance($value, $index, $type);

                continue;
            }

            $this->checkIsValueOfType($valueType, $index, $type);
        }

        parent::__construct($input, 0, 'ArrayIterator');

        $this->itemsComparator = $itemsComparator ?: new IdentityComparator();
    }

    /**
     * @param  mixed $item
     *
     * @return bool
     */
    public function contains($item)
    {
        foreach ($this as $innerItem) {
            if ($this->itemsComparator->compare($item, $innerItem)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Checks if the given value is an instance of the wanted class or interface.
     *
     * @param mixed $value
     * @param int $index
     * @param string $type
     *
     * @throws InvalidArgumentException if the object is not of the wanted class or interface.
     */
    private function checkIsObjectOfInstance($value, $index, $type)
    {
        if (!$value instanceof $type) {
            throw new InvalidArgumentException(sprintf(
                'Element %d of the input array is not an instance of %s. %s given.',
                $index,
                $type,
                get_class($value)
            ));
        }
    }

    /**
     * Checks if the given value is of the wanted scalar type.
     *
     * @param string $valueType
     * @param int $index
     * @param string $type
     *
     * @throws InvalidArgumentException if the value is not of scalar type.
     */
    private function checkIsValueOfType($valueType, $index, $type)
    {
        if ($type !== $valueType) {
            throw new InvalidArgumentException(sprintf(
                'Element %d of the input array is not a %s. %s given.',
                $index,
                $type,
                $valueType
            ));
        }
    }
}
