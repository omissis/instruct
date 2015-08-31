<?php

namespace FOD\Instruct\DataProcessor;

class LowercaseDataProcessor implements DataProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function process($value)
    {
        return strtolower($value);
    }
}
