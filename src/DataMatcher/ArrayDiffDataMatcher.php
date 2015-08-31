<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;
use FOD\Instruct\TypeChecker\ArrayTypeChecker;

use InvalidArgumentException;

final class ArrayDiffDataMatcher extends AbstractDataMatcher
{
    /**
     * {@inheritdoc}
     */
    protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object)
    {
        ArrayTypeChecker::scheck($subject->getValue(), 'subject');

        $diff = array_diff($subject->getValue()[0], $subject->getValue()[1]);

        return $diff == $object->getValue();
    }
}
