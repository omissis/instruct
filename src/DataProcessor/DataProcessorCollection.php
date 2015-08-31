<?php

namespace FOD\Instruct\DataProcessor;

use FOD\Instruct\Collection\TypeCollection;

/**
 * Class that holds a collection of DataProcessors.
 */
class DataProcessorCollection extends TypeCollection implements DataProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $input = [])
    {
        parent::__construct($input, 'FOD\Instruct\DataProcessor\DataProcessorInterface');
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
