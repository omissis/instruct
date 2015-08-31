<?php

namespace FOD\Instruct\DataMatcher;

/**
 * DataMatcherInterface is an interface for strategies to match a value.
 */
interface DataMatcherInterface
{
    const FIELD_NONE    = 0;
    const FIELD_SUBJECT = 1;
    const FIELD_OBJECT  = 2;
    const FIELD_BOTH    = 3;

    /**
     * Decides whether a subject's value matches an object's one
     * given the concrete matching rule.
     *
     * The semantics of the DataMatcher can be expressed in the form of a simple
     * statement where a subject A matches the object B.
     *
     * @param mixed $subject The subject to be matched
     * @param mixed $object The object to use for the match
     *
     * @return bool true if the values match, false otherwise
     */
    public function match($subject, $object);
}
