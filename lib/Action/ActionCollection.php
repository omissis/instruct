<?php

namespace FOD\Instruct\Action;

use FOD\Instruct\Context\ContextInterface;

use ArrayObject,
    InvalidArgumentException;

class ActionCollection extends ArrayObject implements ActionInterface
{
    public function __construct($input = [], $flags = 0, $iteratorClass = 'ArrayIterator')
    {
        array_walk($input, function ($action, $index) {
            if (!$action instanceof ActionInterface) {
                throw new InvalidArgumentException(
                    "Element $index of the input array is not an instance of FOD\Instruct\Action\ActionInterface."
                );
            }
        });

        parent::__construct($input, $flags, $iteratorClass);
    }

    public function execute(ContextInterface $context)
    {
        foreach ($this as $innerAction) {
            $innerAction->execute($context);
        }
    }

    public function contain(ActionInterface $action)
    {
        foreach ($this as $innerAction) {
            if ($innerAction->isEqualTo($action)) {
                return true;
            }
        }

        return false;
    }
}
