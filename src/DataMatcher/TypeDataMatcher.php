<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;
use FOD\Instruct\Reflection\Fqdn;

final class TypeDataMatcher extends DataMatcher
{
    /**
     * @param DataMatcherArgument $subject
     * @param DataMatcherArgument $object
     *
     * @return bool
     */
    protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object)
    {
        if (is_object($subject->getValue())) {
            $subjectFqdn = new Fqdn(get_class($subject->getValue()));
            $objectFqdn = new Fqdn($object->getValue());

            if ($subjectFqdn->isEqualTo($objectFqdn)) {
                return true;
            }
        }

        if ($object->getValue() === gettype($subject->getValue())) {
            return true;
        }

        return false;
    }
}
