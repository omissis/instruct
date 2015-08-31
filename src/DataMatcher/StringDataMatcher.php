<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataProcessor\LowercaseDataProcessor;
use FOD\Instruct\DataProcessor\TrimDataProcessor;

abstract class StringDataMatcher extends AbstractDataMatcher implements StringDataMatcherInterface
{
    const MATCHER_ID_CASE_SENSITIVE = 'matcher_string_case_sensitive';
    const MATCHER_ID_TRIM = 'matcher_string_trim';

    /**
     * {@inheritdoc}
     */
    public function setCaseSensitive($fieldId = DataMatcherField::VALUE_BOTH)
    {
        $this->removeFieldsProcessor(
            self::MATCHER_ID_CASE_SENSITIVE,
            new DataMatcherField($fieldId)
        );
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function unsetTrimmed($fieldId = DataMatcherField::VALUE_BOTH)
    {
        $this->removeFieldsProcessor(
            self::MATCHER_ID_TRIM,
            new DataMatcherField($fieldId)
        );
    }
}
