<?php

/**
 * @file
 * Contains \FOD\Instruct\DataMatcher\ArrayKeyExistsDataMatcher.
 */

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;

final class ArrayHasKeyDataMatcher extends DataMatcher {

  /**
   * {@inheritdoc}
   */
  protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object) {
    return isset($subject->getValue()[$object->getValue()]);
  }

}
