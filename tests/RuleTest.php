<?php

namespace FOD\Instruct\Tests;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\Rule;
use FOD\Instruct\Event\EventName;

class RuleTest extends TestCase
{
    const TEST_EVENT_NAME = 'foo:bar';

    public function setUp()
    {
        $this->eventNames = $this->prophesize('FOD\Instruct\Event\EventNameCollection');
        $this->conditions = $this->prophesize('FOD\Instruct\Condition\ConditionInterface');
        $this->actions = $this->prophesize('FOD\Instruct\Action\ActionInterface');
        $this->contextBuilder = $this->prophesize('FOD\Instruct\Context\ContextBuilderInterface');

        $this->rule = new Rule(
            $this->eventNames->reveal(),
            $this->conditions->reveal(),
            $this->actions->reveal(),
            $this->contextBuilder->reveal()
        );

        $this->event = $this->prophesize('FOD\Instruct\Event\EventInterface');
        $this->context = $this->prophesize('FOD\Instruct\Context\ContextInterface');
    }

    public function tearDown()
    {
        $this->context = null;
        $this->event = null;
        $this->rule = null;
        $this->contextBuilder = null;
        $this->actions = null;
        $this->conditions = null;
        $this->eventNames = null;
    }

    public function testAppliesOnRegisteredEvent()
    {
        $eventName = new EventName(self::TEST_EVENT_NAME);

        $this->event->getName()->willReturn($eventName);

        $this->contextBuilder
            ->addEvent($this->event->reveal())
            ->willReturn($this->contextBuilder->reveal())->shouldBeCalledTimes(1);

        $this->contextBuilder->getContext()->willReturn($this->context->reveal())->shouldBeCalledTimes(1);

        $this->eventNames->contain($eventName)->willReturn(true)->shouldBeCalledTimes(1);

        $this->conditions->verify($this->context->reveal())->willReturn(true)->shouldBeCalledTimes(1);

        $this->actions->execute($this->context->reveal())->willReturn(null)->shouldBeCalledTimes(1);

        $this->rule->apply($this->event->reveal());
    }

    public function testDoesntApplyOnUnregisteredEvent()
    {
        $eventName = new EventName('wrong');

        $this->event->getName()->willReturn($eventName);

        $this->eventNames->contain($eventName)->willReturn(false)->shouldBeCalledTimes(1);

        $this->conditions->verify()->shouldBeCalledTimes(0);

        $this->actions->execute()->shouldBeCalledTimes(0);

        $this->rule->apply($this->event->reveal());
    }

    public function testDoesntApplyOnUnmatchedConditions()
    {
        $eventName = new EventName(self::TEST_EVENT_NAME);

        $this->event->getName()->willReturn($eventName);

        $this->contextBuilder->addEvent($this->event->reveal())
            ->willReturn($this->contextBuilder->reveal())
            ->shouldBeCalledTimes(1);

        $this->contextBuilder->getContext()->willReturn($this->context->reveal())->shouldBeCalledTimes(1);

        $this->eventNames->contain($eventName)->willReturn(true)->shouldBeCalledTimes(1);

        $this->conditions->verify($this->context->reveal())->willReturn(false)->shouldBeCalledTimes(1);

        $this->actions->execute()->shouldBeCalledTimes(0);

        $this->rule->apply($this->event->reveal());
    }
}
