<?php

namespace FOD\Instruct\Action;

use FOD\Instruct\Context\ContextInterface;

interface ActionInterface
{
    /**
     * Execute the action.
     *
     * @param ContextInterface $context
     */
    public function execute(ContextInterface $context);

    /**
     * @param ActionInterface $event
     *
     * @return boolean
     */
    public function isEqualTo(ActionInterface $action);
}
