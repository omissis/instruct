<?php

namespace Drupal\Tests\rules\Unit\DataMatcher;

use FOD\Instruct\DataMatcher\ArrayHasKeyDataMatcher;

use PHPUnit_Framework_TestCase as TestCase;

class ArrayHasKeyDataMatcherTest extends TestCase
{
    /**
     * @dataProvider arrayValuesProvider
     */
    public function testMatch($expectedMatchResult, $subject, $object)
    {
        $matcher = ArrayHasKeyDataMatcher::create();

        $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
    }

    public function arrayValuesProvider()
    {
        return [
            [true, [1],        0],
            [true, [1, 2],     1],
            [true, ['a' => 1], 'a'],

            [false, [2],        1],
            [false, [2, 3],     2],
            [false, [1 => 'a'], 'a'],
        ];
    }
}
