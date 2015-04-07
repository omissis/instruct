<?php

namespace FOD\Instruct;

use FOD\Instruct\Event\EventCollection;
use FOD\Instruct\Event\EventInterface;
use FOD\Instruct\Condition\ConditionInterface;
use FOD\Instruct\Action\ActionInterface;
use FOD\Instruct\Context\ContextBuilderInterface;

final class Rule
{
    /**
     * @var EventCollection
     */
    private $events;

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
     * @param EventCollection         $events
     *   A list of events that this rule applies to.
     * @param ConditionInterface      $conditions
     *   A Composite condition that determines if this rule should execute or not.
     * @param ActionInterface         $actions
     *   A Composite action to execute.
     * @param ContextBuilderInterface $contextBuilder
     *   A Context builder object.
     */
    public function __construct(
        EventCollection $events,
        ConditionInterface $conditions,
        ActionInterface $actions,
        ContextBuilderInterface $contextBuilder
    ) {
        $this->events = $events;
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
        $eventWasFound = $this->events->contain($event);

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
