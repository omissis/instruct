<?php

namespace FOD\Instruct\Condition;

use FOD\Instruct\Context\ContextInterface;

interface ConditionInterface
{
    /**
     * Verify the condition in the given context.
     *
     * @param ContextInterface $context
     *
     * @return bool
     */
    public function verify(ContextInterface $context);
}
