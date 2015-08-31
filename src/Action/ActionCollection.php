<?php

namespace FOD\Instruct\Action;

use FOD\Instruct\Context\ContextInterface;

use ArrayObject;
use InvalidArgumentException;

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

    public function contains(ActionInterface $action)
    {
        foreach ($this as $innerAction) {
            if ($innerAction->isEqualTo($action)) {
                return true;
            }
        }

        return false;
    }

    public function isEqualTo(ActionInterface $action)
    {
        if (count($this) !== count($action)) {
            return false;
        }

        $matches = [];

        foreach ($this as $i => $innerAction) {
            foreach ($action as $j => $outerAction) {
                // Don't match the same action twice
                if (in_array($j, $matches, true)) {
                    continue;
                }

                if ($innerAction->isEqualTo($outerAction)) {
                    $matches[$i] = $j;
                    break;
                }
            }
        }

        return count($matches) === count($this);
    }
}
