<?php

/**
 * @file
 * Contains \FOD\Instruct\DataProcessor\DataProcessorInterface.
 */

namespace FOD\Instruct\DataProcessor;

/**
 * Interface for Rules data processor plugins.
 */
interface DataProcessorInterface {

  /**
   * Process the given value.
   *
   * @param mixed $value
   *   The value to process.
   *
   * @return mixed
   *   The processed value. Since the value can also be a primitive data type
   *   (a string for example) this function must return the value.
   */
  public function process($value);

}
