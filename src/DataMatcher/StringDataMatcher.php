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
     * Set the fields that should be matched in a case sensitive fashion.
     *
     * @param int $fields
     */
    public function setCaseSensitive($fields = DataMatcherInterface::FIELD_BOTH)
    {
        if (!is_int($fields)) {
            throw new InvalidArgumentException('Argument "$fields" should be of type int.');
        }

        $this->removeFieldsProcessor(self::MATCHER_ID_CASE_SENSITIVE, $fields);
    }

    /**
     * Unset the fields that should be matched in a case sensitive fashion.
     *
     * @param int $fields
     */
    public function setCaseInsensitive($fields = DataMatcherInterface::FIELD_BOTH)
    {
        if (!is_int($fields)) {
            throw new InvalidArgumentException('Argument "$fields" should be of type int.');
        }

        $this->setFieldsProcessor(self::MATCHER_ID_CASE_SENSITIVE, $fields, new LowercaseDataProcessor());
    }

    /**
     * Set the fields that should be trimmed before matching.
     *
     * @param int $fields
     */
    public function setTrimmed($fields = DataMatcherInterface::FIELD_BOTH)
    {
        if (!is_int($fields)) {
            throw new InvalidArgumentException('Argument "$fields" should be of type int.');
        }

        $this->setFieldsProcessor(self::MATCHER_ID_TRIM, $fields, new TrimDataProcessor());
    }

    /**
     * Unset the fields that should be trimmed before matching.
     *
     * @param int $fields
     */
    public function unsetTrimmed($fields = DataMatcherInterface::FIELD_BOTH)
    {
        if (!is_int($fields)) {
            throw new InvalidArgumentException('Argument "$fields" should be of type int.');
        }

        $this->removeFieldsProcessor(self::MATCHER_ID_TRIM, $fields);
    }
}
