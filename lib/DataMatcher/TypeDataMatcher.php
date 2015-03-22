<?php

/**
 * @file
 * Contains \FOD\Instruct\DataMatcher\ObjectTypeDataMatcher.
 */

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;

final class TypeDataMatcher extends DataMatcher {

  /**
   * @param object|string $subject
   * @param string $object
   *
   * @return boolean
   */
  protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object) {
    if (is_object($subject->getValue()) && ltrim(get_class($subject->getValue()), '\\') === ltrim($object->getValue(), '\\')) {
      return TRUE;
    }

    if ($object->getValue() === gettype($subject->getValue())) {
      return TRUE;
    }

    return FALSE;
  }

}
