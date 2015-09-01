<?php

namespace FOD\Instruct\Action;

use FOD\Instruct\Context\ContextInterface;
use FOD\Instruct\Collection\TypeCollection;
use FOD\Instruct\Comparator\IsEqualToComparator;

class ActionCollection extends TypeCollection implements ActionInterface
{
    public function __construct(array $input = [])
    {
        parent::__construct($input, 'FOD\Instruct\Action\ActionInterface', new IsEqualToComparator());
    }

    /**
     * {@inheritdoc}
     */
    public function execute(ContextInterface $context)
    {
        foreach ($this as $innerAction) {
            $innerAction->execute($context);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isEqualTo(ActionInterface $action)
    {
        if (!$action instanceof ActionCollection) {
            $action = new ActionCollection([$action]);
        }

        return $this->isEqualToCollection($action);
    }

    /**
     * Compares the current collection with the given one.
     *
     * @param ActionCollection $actions
     *
     * @return bool
     */
    public function isEqualToCollection(ActionCollection $actions)
    {
        if (count($this) !== count($actions)) {
            return false;
        }

        $matches = [];

        foreach ($this as $i => $innerAction) {
            foreach ($actions as $j => $outerAction) {
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
