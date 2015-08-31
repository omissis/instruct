<?php

namespace FOD\Instruct\Tests\DataMatcher;

use FOD\Instruct\DataMatcher\ArrayCountDataMatcher;

use PHPUnit_Framework_TestCase as TestCase;

class ArrayCountDataMatcherTest extends TestCase
{
    /**
     * @dataProvider arrayValuesProvider
     */
    public function testMatch($expectedMatchResult, $subject, $object)
    {
        $matcher = ArrayCountDataMatcher::create();

        $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
    }

    public function arrayValuesProvider()
    {
        return [
            [true, [1],        1],
            [true, [1, 2],     2],
            [true, ['a' => 1], 1],

            [false, [2],        2],
            [false, [2, 3],     1],
            [false, [1 => 'a'], 2],
        ];
    }
}
