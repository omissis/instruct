<?php

namespace FOD\Instruct\Tests\Comparator;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\Comparator\IdentityComparator;

use stdClass;

class EventCollectionTest extends TestCase
{
    public function setUp()
    {
        $this->comparator = new IdentityComparator();
    }

    public function tearDown()
    {
        $this->comparator = null;
    }

    /**
     * @dataProvider itemsProvider
     */
    public function testComparison($expected, $firstItem, $secondItem)
    {
        $this->assertSame($expected, $this->comparator->compare($firstItem, $secondItem));
    }

    public function itemsProvider()
    {
        $obj = new stdClass();

        return [
            [true, 1, 1],
            [true, 1.1, 1.1],
            [true, "1", "1"],
            [true, ["1"], ["1"]],
            [true, false, false],
            [true, $obj, $obj],
            [false, new stdClass(), new stdClass()],
            [false, 1, "1"],
            [false, 1, 1.0],
            [false, [1], ["1"]],
        ];
    }
}
