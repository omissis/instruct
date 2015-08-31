<?php

namespace FOD\Instruct\Tests\DataMatcher;

use FOD\Instruct\DataMatcher\StringContainsDataMatcher;
use FOD\Instruct\DataMatcher\DataMatcherInterface;
use PHPUnit_Framework_TestCase as TestCase;

class StringContainsDataMatcherTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Data matcher field should be an int. 'foo' given.
     */
    public function testSetCaseSensitive()
    {
        $matcher = StringContainsDataMatcher::create();

        $matcher->setCaseSensitive('foo');
    }

    /**
     * @dataProvider caseSensitiveMatchesProvider
     */
    public function testCaseSensitiveMatch($expectedMatchResult, $subject, $object)
    {
        $matcher = StringContainsDataMatcher::create();

        $matcher->setCaseSensitive();

        $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
    }

    /**
     * @dataProvider caseInsensitiveMatchesProvider
     */
    public function testCaseInsensitiveMatch($expectedMatchResult, $subject, $object)
    {
        $matcher = StringContainsDataMatcher::create();

        $matcher->setCaseInsensitive();

        $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
    }

    public function caseSensitiveMatchesProvider()
    {
        return [
            [true, 'foo', 'foo'],
            [true, 'foobar', 'oob'],
            [true, 'foobarfoobar', 'foo'],

            [false, 'foo', 'FOO'],
            [false, 'foobar', 'OOB'],
            [false, 'foobarfoobar', 'FOO'],
        ];
    }

    public function caseInsensitiveMatchesProvider()
    {
        return [
            [true, 'foo', 'foo'],
            [true, 'foobar', 'oob'],
            [true, 'foobarfoobar', 'foo'],

            [true, 'foo', 'FOO'],
            [true, 'foobar', 'OOB'],
            [true, 'foobarfoobar', 'FOO'],
        ];
    }
}
