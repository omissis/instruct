<?php

/**
 * @file
 * Contains \FOD\Instruct\DataProcessor\LowercaseDataProcessor.
 */

namespace FOD\Instruct\DataProcessor;

use FOD\Instruct\DataProcessor\DataProcessorInterface;

class LowercaseDataProcessor implements DataProcessorInterface {

  /**
   * {@inheritdoc}
   */
  public function process($value) {
    return strtolower($value);
  }

}
