<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;

final class StringRegexpDataMatcher extends StringDataMatcher
{
    /**
     * @var int
     */
    private $flags = 0;

    /**
     * @var int
     */
    private $offset = 0;

    /**
     * @param int $flags
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
    }

    /**
     * @param int $offset
     */
    public function setOffest($offset)
    {
        $this->offset = $offset;
    }

    /**
     * {@inheritdoc}
     */
    protected function doMatch(DataMatcherArgument $subject, DataMatcherArgument $object)
    {
        $matches = [];

        return 1 === preg_match($object->getValue(), $subject->getValue(), $matches, $this->flags, $this->offset);
    }
}
