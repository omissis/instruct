<?php

/**
 * @file
 * Contains \FOD\Instruct\DataProcessor\DataProcessorCollection.
 */

namespace FOD\Instruct\DataProcessor;

use FOD\Instruct\DataProcessor\DataProcessorInterface;

/**
 * Class that holds a collection of DataProcessors.
 */
class DataProcessorCollection extends \ArrayObject implements DataProcessorInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct ($input, $flags = 0, $iterator_class = "ArrayIterator") {
    parent::__construct($input, $flags, $iterator_class);
  }

  /**
   * {@inheritdoc}
   */
  public function process($value) {
    $processors = $this->getArrayCopy();

    if (empty($processors)) {
      return $value;
    }

    return array_reduce($processors, function ($carry, DataProcessorInterface $processor) use ($value) {
      return $processor->process($carry ?: $value);
    });
  }

}
