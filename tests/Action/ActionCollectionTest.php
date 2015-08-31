<?php

namespace FOD\Instruct\Tests\Action;

use PHPUnit_Framework_TestCase as TestCase;

use stdClass;

use FOD\Instruct\Action\ActionCollection;

class ActionCollectionTest extends TestCase
{
    public function testEmptyInstatiation()
    {
        $actions = new ActionCollection([]);

        $this->assertInstanceOf('FOD\Instruct\Action\ActionCollection', $actions);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Element 1 of the input array is not an instance of FOD\Instruct\Action\ActionInterface.
     */
    public function testWrongTypeInstatiation()
    {
        $action = $this->prophesize('FOD\Instruct\Action\ActionInterface');

        new ActionCollection([$action->reveal(), new stdClass()]);
    }

    public function testContainsActions()
    {
        $action1 = $this->prophesize('FOD\Instruct\Action\ActionInterface');
        $action2 = $this->prophesize('FOD\Instruct\Action\ActionInterface');

        $action1->isEqualTo($action1->reveal())->willReturn(true)->shouldBeCalledTimes(1);
        $action1->isEqualTo($action2->reveal())->willReturn(false)->shouldBeCalledTimes(1);

        $actions = new ActionCollection([$action1->reveal()]);

        $this->assertTrue($actions->contains($action1->reveal()));
        $this->assertFalse($actions->contains($action2->reveal()));
    }

    public function testComparesToActions()
    {
        $action1 = $this->prophesize('FOD\Instruct\Action\ActionInterface');
        $action2 = $this->prophesize('FOD\Instruct\Action\ActionInterface');
        $action3 = $this->prophesize('FOD\Instruct\Action\ActionInterface');

        $action1->isEqualTo($action1->reveal())->willReturn(true);
        $action1->isEqualTo($action2->reveal())->willReturn(false);
        $action1->isEqualTo($action3->reveal())->willReturn(false);

        $action2->isEqualTo($action1->reveal())->willReturn(false);
        $action2->isEqualTo($action2->reveal())->willReturn(true);
        $action2->isEqualTo($action3->reveal())->willReturn(false);

        $action3->isEqualTo($action1->reveal())->willReturn(false);
        $action3->isEqualTo($action2->reveal())->willReturn(false);
        $action3->isEqualTo($action3->reveal())->willReturn(true);

        $actions1 = new ActionCollection([$action1->reveal(), $action2->reveal()]);
        $actions2 = new ActionCollection([$action2->reveal(), $action1->reveal()]);
        $actions3 = new ActionCollection([$action1->reveal()]);
        $actions4 = new ActionCollection([$action1->reveal(), $action3->reveal()]);

        $this->assertTrue($actions1->isEqualTo($actions2));
        $this->assertFalse($actions1->isEqualTo($actions3));
        $this->assertFalse($actions1->isEqualTo($actions4));
    }

    public function testExecutesAllActions()
    {
        $context = $this->prophesize('FOD\Instruct\Context\ContextInterface');

        $action1 = $this->prophesize('FOD\Instruct\Action\ActionInterface');
        $action2 = $this->prophesize('FOD\Instruct\Action\ActionInterface');
        $action3 = $this->prophesize('FOD\Instruct\Action\ActionInterface');

        $action1->execute($context->reveal())->willReturn(null)->shouldBeCalledTimes(1);
        $action2->execute($context->reveal())->willReturn(null)->shouldBeCalledTimes(1);
        $action3->execute($context->reveal())->willReturn(null)->shouldBeCalledTimes(1);

        $actions = new ActionCollection([$action1->reveal(), $action2->reveal(), $action3->reveal()]);

        $this->assertNull($actions->execute($context->reveal()));
    }
}
