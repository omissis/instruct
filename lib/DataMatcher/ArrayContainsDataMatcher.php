<?php

/**
 * @file
 * Contains \FOD\Instruct\DataMatcher\ArrayContainsDataMatcher.
 */

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;

final class ArrayContainsDataMatcher extends DataMatcher {

  /**
   * {@inheritdoc}
   */
  protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object) {
    return is_array($subject->getValue()) && in_array($object->getValue(), $subject->getValue());
  }

}
