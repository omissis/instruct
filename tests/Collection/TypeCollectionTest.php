<?php

namespace FOD\Instruct\Tests\Collection;

use FOD\Instruct\Collection\TypeCollection;
use PHPUnit_Framework_TestCase as TestCase;

use ArrayObject;
use stdClass;

class DataMatchesTest extends TestCase
{
    public function testCanHoldOneKindOfScalarType()
    {
        new TypeCollection(['foo']);
    }

    public function testCanHoldOneKindOfObjectType()
    {
        new TypeCollection([new ArrayObject([])], '\ArrayObject');
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Element 1 of the input array is not an instance of \ArrayObject. stdClass given.
     */
    public function testCannotHoldTwoKindOfObjectTypes()
    {
        new TypeCollection([new ArrayObject([]), new stdClass()], '\ArrayObject');
    }
}
