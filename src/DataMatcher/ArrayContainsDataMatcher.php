<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;

final class ArrayContainsDataMatcher extends AbstractDataMatcher
{
    /**
     * {@inheritdoc}
     */
    protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object)
    {
        return is_array($subject->getValue()) && in_array($object->getValue(), $subject->getValue());
    }
}
