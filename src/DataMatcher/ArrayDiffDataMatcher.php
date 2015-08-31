<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;

use InvalidArgumentException;

final class ArrayDiffDataMatcher extends AbstractDataMatcher
{
    /**
     * {@inheritdoc}
     */
    protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object)
    {
        if (!is_array($subject->getValue())) {
            throw new InvalidArgumentException(sprintf(
                "Subject shoud be an array. '%s' given.",
                var_export($subject->getValue(), true)
            ));
        }

        $diff = array_diff($subject->getValue()[0], $subject->getValue()[1]);

        return $diff == $object->getValue();
    }
}
