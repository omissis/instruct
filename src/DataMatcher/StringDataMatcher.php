<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataProcessor\LowercaseDataProcessor;
use FOD\Instruct\DataProcessor\TrimDataProcessor;

use InvalidArgumentException;

abstract class StringDataMatcher extends DataMatcher implements StringDataMatcherInterface
{
    const MATCHER_ID_CASE_SENSITIVE = 'matcher_string_case_sensitive';
    const MATCHER_ID_TRIM = 'matcher_string_trim';

    /**
     * Set the field that should be matched in a case sensitive fashion.
     *
     * @param int $fieldId
     */
    public function setCaseSensitive($fieldId = DataMatcherField::VALUE_BOTH)
    {
        $this->removeFieldsProcessor(
            self::MATCHER_ID_CASE_SENSITIVE,
            new DataMatcherField($fieldId)
        );
    }

    /**
     * Unset the field that should be matched in a case sensitive fashion.
     *
     * @param int $fieldId
     */
    public function setCaseInsensitive($fieldId = DataMatcherField::VALUE_BOTH)
    {
        $this->setFieldsProcessor(
            self::MATCHER_ID_CASE_SENSITIVE,
            new DataMatcherField($fieldId),
            new LowercaseDataProcessor()
        );
    }

    /**
     * Set the field that should be trimmed before matching.
     *
     * @param int $fieldId
     */
    public function setTrimmed($fieldId = DataMatcherField::VALUE_BOTH)
    {
        $this->setFieldsProcessor(
            self::MATCHER_ID_TRIM,
            new DataMatcherField($fieldId),
            new TrimDataProcessor()
        );
    }

    /**
     * Unset the field that should be trimmed before matching.
     *
     * @param int $fieldId
     */
    public function unsetTrimmed($fieldId = DataMatcherField::VALUE_BOTH)
    {
        $this->removeFieldsProcessor(
            self::MATCHER_ID_TRIM,
            new DataMatcherField($fieldId)
        );
    }
}
