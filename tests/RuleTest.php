<?php

namespace FOD\Instruct\Tests;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\Rule;

class RuleTest extends TestCase
{
    public function setUp()
    {
        $this->events = $this->prophesize('FOD\Instruct\Event\EventCollection');
        $this->conditions = $this->prophesize('FOD\Instruct\Condition\ConditionInterface');
        $this->actions = $this->prophesize('FOD\Instruct\Action\ActionInterface');
        $this->contextBuilder = $this->prophesize('FOD\Instruct\Context\ContextBuilderInterface');
    }

    public function testInstatiation()
    {
        new Rule(
            $this->events->reveal(),
            $this->conditions->reveal(),
            $this->actions->reveal(),
            $this->contextBuilder->reveal()
        );
    }

    public function testAppliesOnRegisteredEvent()
    {
        $event = $this->prophesize('FOD\Instruct\Event\EventInterface');
        $context = $this->prophesize('FOD\Instruct\Context\ContextInterface');

        $this->contextBuilder->addEvent($event->reveal())->willReturn($this->contextBuilder->reveal())->shouldBeCalledTimes(1);
        $this->contextBuilder->getContext()->willReturn($context->reveal())->shouldBeCalledTimes(1);

        $rule = new Rule(
            $this->events->reveal(),
            $this->conditions->reveal(),
            $this->actions->reveal(),
            $this->contextBuilder->reveal()
        );

        $this->events->contain($event->reveal())->willReturn(true)->shouldBeCalledTimes(1);

        $this->conditions->verify($context->reveal())->willReturn(true)->shouldBeCalledTimes(1);

        $this->actions->execute($context->reveal())->willReturn(null)->shouldBeCalledTimes(1);

        $rule->apply($event->reveal());
    }
}
