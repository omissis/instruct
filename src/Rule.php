<?php

namespace FOD\Instruct;

use FOD\Instruct\Event\EventNameCollection;
use FOD\Instruct\Event\EventInterface;
use FOD\Instruct\Condition\ConditionInterface;
use FOD\Instruct\Action\ActionInterface;
use FOD\Instruct\Context\ContextBuilderInterface;

final class Rule
{
    /**
     * @var EventNameCollection
     */
    private $eventNames;

    /**
     * @var ConditionInterface
     */
    private $conditions;

    /**
     * @var ActionInterface
     */
    private $actions;

    /**
     * @var ContextBuilderInterface
     */
    private $contextBuilder;

    /**
     * @param EventNameCollection     $eventNames
     *   A list of event names that this rule applies on.
     * @param ConditionInterface      $conditions
     *   A Composite condition that determines if this rule should execute or not.
     * @param ActionInterface         $actions
     *   A Composite action to execute.
     * @param ContextBuilderInterface $contextBuilder
     *   A Context builder object.
     */
    public function __construct(
        EventNameCollection $eventNames,
        ConditionInterface $conditions,
        ActionInterface $actions,
        ContextBuilderInterface $contextBuilder
    ) {
        $this->eventNames = $eventNames;
        $this->conditions = $conditions;
        $this->actions = $actions;
        $this->contextBuilder = $contextBuilder;
    }

    /**
     * Execute one or more actions when one or more events happen and one or more conditions are verified.
     *
     * @param EventInterface $event
     */
    public function apply(EventInterface $event)
    {
        $eventWasFound = $this->eventNames->contains($event->getName());

        if (!$eventWasFound) {
            return;
        }

        $context = $this->contextBuilder->addEvent($event)->getContext();

        $conditionsWereVerified = $this->conditions->verify($context);

        if (!$conditionsWereVerified) {
            return;
        }

        $this->actions->execute($context);
    }
}
