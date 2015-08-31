<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;
use FOD\Instruct\TypeChecker\ArrayTypeChecker;

use InvalidArgumentException;

final class ArrayIntersectDataMatcher extends AbstractDataMatcher
{
    /**
     * {@inheritdoc}
     */
    protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object)
    {
        ArrayTypeChecker::check($subject->getValue(), 'subject');

        $intersect = array_intersect($subject->getValue()[0], $subject->getValue()[1]);

        return $intersect == $object->getValue();
    }
}
