<?php

namespace FOD\Instruct\DataProcessor;

class TrimDataProcessor implements DataProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function process($value)
    {
        return trim($value);
    }
}
