<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;

final class StringEqualsDataMatcher extends AbstractStringDataMatcher
{
    /**
     * {@inheritdoc}
     */
    protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object)
    {
        return $object->getValue() === $subject->getValue();
    }
}
