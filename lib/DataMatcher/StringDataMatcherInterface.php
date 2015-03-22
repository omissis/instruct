<?php

/**
 * @file
 * Contains \FOD\Instruct\DataMatcher\StringDataMatcherInterface.
 */

namespace FOD\Instruct\DataMatcher;

/**
 * StringMatcherInterface is an interface for strategies to match string values.
 */
interface StringDataMatcherInterface extends DataMatcherInterface {

  /**
   * Set what fields should be treated as case sensitive.
   *
   * @param int $field
   *   What field the Case Sensitiveness should be applied to.
   */
  public function setCaseSensitive($field = DataMatcherInterface::FIELD_BOTH);

  /**
   * Set what fields should be not treated as case sensitive.
   *
   * @param int $field
   *   What field the Case Sensitiveness should not be applied to.
   */
  public function setCaseInsensitive($field = DataMatcherInterface::FIELD_BOTH);

  /**
   * Set what fields should be trimmed.
   *
   * @param int $field
   *   What field the Trimming should be applied to.
   */
  public function setTrimmed($field = DataMatcherInterface::FIELD_BOTH);

  /**
   * Set what fields should not be trimmed.
   *
   * @param int $field
   *   What field the Trimming should not be applied to.
   */
  public function unsetTrimmed($field = DataMatcherInterface::FIELD_BOTH);

}
