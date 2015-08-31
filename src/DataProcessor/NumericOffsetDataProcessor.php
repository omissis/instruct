<?php

namespace FOD\Instruct\DataProcessor;

class NumericOffsetDataProcessor implements DataProcessorInterface
{
    /**
     * @var int
     */
    private $offset;

    /**
     * @param int $offset
     */
    public function __construct($offset = 0)
    {
        $this->offset = $offset;
    }

    /**
     * {@inheritdoc}
     */
    public function process($value)
    {
        return $value + $this->offset;
    }
}
