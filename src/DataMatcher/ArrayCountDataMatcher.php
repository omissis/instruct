<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;

final class ArrayCountDataMatcher extends AbstractDataMatcher
{
    /**
     * {@inheritdoc}
     */
    protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object)
    {
        return count($subject->getValue()) === $object->getValue();
    }
}
