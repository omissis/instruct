<?php

namespace FOD\Instruct\DataProcessor;

use ArrayObject;

/**
 * Class that holds a collection of DataProcessors.
 */
class DataProcessorCollection extends ArrayObject implements DataProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct($input, $flags = 0, $iteratorClass = 'ArrayIterator')
    {
        parent::__construct($input, $flags, $iteratorClass);
    }

    /**
     * {@inheritdoc}
     */
    public function process($value)
    {
        $processors = $this->getArrayCopy();

        if (empty($processors)) {
            return $value;
        }

        return array_reduce($processors, function ($carry, DataProcessorInterface $processor) use ($value) {
            return $processor->process($carry ?: $value);
        });
    }
}
