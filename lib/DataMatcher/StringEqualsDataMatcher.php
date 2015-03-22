<?php

/**
 * @file
 * Contains \FOD\Instruct\DataMatcher\StringEqualsDataMatcher.
 */

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;

final class StringEqualsDataMatcher extends StringDataMatcher {

  /**
   * {@inheritdoc}
   */
  protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object) {
    return $object->getValue() === $subject->getValue();
  }

}
