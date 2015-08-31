<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;

final class StringContainsDataMatcher extends AbstractStringDataMatcher
{
    /**
     * @var int
     */
    private $offset = 0;

    /**
     * @param int $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * {@inheritdoc}
     */
    protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object)
    {
        return false !== strpos($subject->getValue(), $object->getValue(), $this->offset);
    }
}
