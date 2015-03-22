<?php

/**
 * @file
 * Contains \FOD\Instruct\DataMatcher\String\LevenshteinDataMatcher.
 */

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;

final class StringLevenshteinDataMatcher extends StringDataMatcher {

  /**
   * @var int
   */
  private $threshold;

  /**
   * Threshold for levenstein function.
   *
   * @param int $threshold
   */
  public function setThreshold($threshold) {
    $this->threshold = $threshold;
  }

  /**
   * Return the threshold value for the levenshtein function.
   *
   * @return int
   */
  protected function getThreshold() {
    return isset($this->threshold) ? $this->threshold : 1;
  }

  /**
   * {@inheritdoc}
   */
  protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object) {
    return $this->getThreshold() >= levenshtein($subject->getValue(), $object->getValue());
  }

}
