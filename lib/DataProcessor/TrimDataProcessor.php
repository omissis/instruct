<?php

/**
 * @file
 * Contains \FOD\Instruct\DataProcessor\TrimDataProcessor.
 */

namespace FOD\Instruct\DataProcessor;

use FOD\Instruct\DataProcessor\DataProcessorInterface;

class TrimDataProcessor implements DataProcessorInterface {

  /**
   * {@inheritdoc}
   */
  public function process($value) {
    return trim($value);
  }

}
