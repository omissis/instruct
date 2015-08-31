<?php

namespace FOD\Instruct\DataMatcher;

/**
 * StringMatcherInterface is an interface for strategies to match string values.
 */
interface StringDataMatcherInterface extends DataMatcherInterface
{
    /**
     * Set what fields should be treated as case sensitive.
     *
     * @param int $fieldId
     *   What field the Case Sensitiveness should be applied to.
     *
     * @return null
     */
    public function setCaseSensitive($fieldId = DataMatcherField::VALUE_BOTH);

    /**
     * Set what fields should be not treated as case sensitive.
     *
     * @param int $fieldId
     *   What field the Case Sensitiveness should not be applied to.
     *
     * @return null
     */
    public function setCaseInsensitive($fieldId = DataMatcherField::VALUE_BOTH);

    /**
     * Set what fields should be trimmed.
     *
     * @param int $fieldId
     *   What field the Trimming should be applied to.
     *
     * @return null
     */
    public function setTrimmed($fieldId = DataMatcherField::VALUE_BOTH);

    /**
     * Set what fields should not be trimmed.
     *
     * @param int $fieldId
     *   What field the Trimming should not be applied to.
     *
     * @return null
     */
    public function unsetTrimmed($fieldId = DataMatcherField::VALUE_BOTH);
}
