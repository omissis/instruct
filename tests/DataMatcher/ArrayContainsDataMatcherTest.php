<?php

namespace Drupal\Tests\rules\Unit\DataMatcher;

use FOD\Instruct\DataMatcher\ArrayContainsDataMatcher;

use PHPUnit_Framework_TestCase as TestCase;

class ArrayContainsDataMatcherTest extends TestCase
{
    /**
     * @dataProvider arrayValuesProvider
     */
    public function testMatch($expectedMatchResult, $subject, $object)
    {
        $matcher = ArrayContainsDataMatcher::create();

        $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
    }

    public function arrayValuesProvider()
    {
        return [
            [true, [1],        1],
            [true, [1, 2],     1],
            [true, ['a' => 1], 1],

            [false, [2],        1],
            [false, [2, 3],     1],
            [false, [1 => 'a'], 1],
        ];
    }
}
