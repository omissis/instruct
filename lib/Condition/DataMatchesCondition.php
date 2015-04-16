<?php

namespace FOD\Instruct\Condition;

use FOD\Instruct\Context\ContextInterface;

class DataMatchesCondition implements ConditionInterface
{
    /**
     * Verify the condition in the given context.
     *
     * @param ContextInterface $context
     */
    public function verify(ContextInterface $context)
    {
        $dataMatcher = $this->createDataMatcher(
            $context->get('data_matcher_fqdn'),
            $context->get('data_matcher_arguments', [])
        );

        return $dataMatcher->match(
            $context->get('subject'),
            $context->get('object')
        );
    }

    private function createDataMatcher($dataMatcherFqdn, array $dataMatcherArguments = [])
    {
        return call_user_func_array([$dataMatcherFqdn, 'create'], $dataMatcherArguments);
    }
}
