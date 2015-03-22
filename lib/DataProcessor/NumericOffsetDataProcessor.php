<?php

/**
 * @file
 * Contains \FOD\Instruct\DataProcessor\NumericOffsetDataProcessor.
 */

namespace FOD\Instruct\DataProcessor;

use FOD\Instruct\DataProcessor\DataProcessorInterface;

class NumericOffsetDataProcessor implements DataProcessorInterface {

  /**
   * @var int
   */
  private $offset;

  /**
   * @param int $offset
   */
  public function __construct($offset = 0) {
    $this->offset = $offset;
  }

  /**
   * {@inheritdoc}
   */
  public function process($value) {
    return $value + $this->offset;
  }

}
