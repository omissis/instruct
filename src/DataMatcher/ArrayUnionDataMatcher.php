<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;
use FOD\Instruct\TypeChecker\ArrayTypeChecker;

use InvalidArgumentException;

final class ArrayUnionDataMatcher extends AbstractDataMatcher
{
    /**
     * {@inheritdoc}
     */
    protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object)
    {
        ArrayTypeChecker::scheck($subject->getValue(), 'subject');

        $union = array_merge(
            array_intersect($subject->getValue()[0], $subject->getValue()[1]),
            array_diff($subject->getValue()[0], $subject->getValue()[1]),
            array_diff($subject->getValue()[1], $subject->getValue()[0])
        );

        return $union == $object->getValue();
    }
}
