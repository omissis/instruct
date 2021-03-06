<?php

namespace FOD\Instruct\Action;

use FOD\Instruct\Context\ContextInterface;

interface ActionInterface
{
    /**
     * Execute the action.
     *
     * @param ContextInterface $context
     *
     * @return null
     */
    public function execute(ContextInterface $context);

    /**
     * @param ActionInterface $action
     *
     * @return boolean
     */
    public function isEqualTo(ActionInterface $action);
}
