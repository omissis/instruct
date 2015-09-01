<?php

namespace FOD\Instruct\Tests\Comparator;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\Comparator\IsEqualToComparator;

use stdClass;

class IsEqualToComparatorTest extends TestCase
{
    public function setUp()
    {
        $this->comparator = new IsEqualToComparator();
    }

    public function tearDown()
    {
        $this->comparator = null;
    }

    /**
     * @dataProvider itemsProvider
     */
    public function testComparisonOnEquatableObjects($expected, $firstItem, $secondItem)
    {
        $this->assertSame($expected, $this->comparator->compare($firstItem, $secondItem));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Second Item is expected to implement isEqualTo() method.
     */
    public function testComparisonOnNonEquatableObjects()
    {
        $action1 = $this->prophesize('FOD\Instruct\Action\ActionInterface');
        $action1->isEqualTo($action1->reveal())->willReturn(true);

        $this->comparator->compare($action1, new stdClass());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Second Item is expected to be an object and to implement isEqualTo() method.
     */
    public function testComparisonOnScalars()
    {
        $action1 = $this->prophesize('FOD\Instruct\Action\ActionInterface');
        $action1->isEqualTo($action1->reveal())->willReturn(true);

        $this->comparator->compare($action1, '');
    }

    public function itemsProvider()
    {
        $action1 = $this->prophesize('FOD\Instruct\Action\ActionInterface');
        $action2 = $this->prophesize('FOD\Instruct\Action\ActionInterface');
        $action3 = $this->prophesize('FOD\Instruct\Action\ActionInterface');

        $action1->isEqualTo($action1->reveal())->willReturn(true);
        $action1->isEqualTo($action2->reveal())->willReturn(true);
        $action1->isEqualTo($action3->reveal())->willReturn(false);

        $action2->isEqualTo($action1->reveal())->willReturn(true);
        $action2->isEqualTo($action2->reveal())->willReturn(true);
        $action2->isEqualTo($action3->reveal())->willReturn(false);

        $action3->isEqualTo($action1->reveal())->willReturn(false);
        $action3->isEqualTo($action2->reveal())->willReturn(false);
        $action3->isEqualTo($action3->reveal())->willReturn(true);

        return [
            [true, $action1->reveal(), $action1->reveal()],
            [true, $action2->reveal(), $action2->reveal()],
            [true, $action3->reveal(), $action3->reveal()],
            [true, $action1->reveal(), $action2->reveal()],
            [true, $action2->reveal(), $action1->reveal()],
            [false, $action3->reveal(), $action1->reveal()],
            [false, $action1->reveal(), $action3->reveal()],
            [false, $action3->reveal(), $action2->reveal()],
            [false, $action2->reveal(), $action3->reveal()],
        ];
    }
}
