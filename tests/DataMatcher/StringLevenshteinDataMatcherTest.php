<?php

namespace FOD\Instruct\Tests\DataMatcher;

use FOD\Instruct\DataMatcher\StringLevenshteinDataMatcher;

use PHPUnit_Framework_TestCase as TestCase;

class StringLevenshteinDataMatcherTest extends TestCase
{
    /**
     * @dataProvider caseSensitiveMatchesProvider
     */
    public function testCaseSensitiveMatch($expectedMatchResult, $threshold, $subject, $object)
    {
        $matcher = StringLevenshteinDataMatcher::create();

        $matcher->setThreshold($threshold);
        $matcher->setCaseSensitive();

        $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
    }

    /**
     * @dataProvider caseInsensitiveMatchesProvider
     */
    public function testCaseInsensitiveMatch($expectedMatchResult, $threshold, $subject, $object)
    {
        $matcher = StringLevenshteinDataMatcher::create();

        $matcher->setThreshold($threshold);
        $matcher->setCaseInsensitive();

        $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
    }

    public function caseSensitiveMatchesProvider()
    {
        return [
            [true, 1, 'foo', 'foo'],
            [true, 1, 'bar', 'baz'],
            [false, 1, 'foo', 'bar'],

            [true, 3, 'foo', 'foo'],
            [true, 3, 'bar', 'baz'],
            [true, 3, 'foo', 'bar'],
        ];
    }

    public function caseInsensitiveMatchesProvider()
    {
        return [
            [true, 1, 'foo', 'FOO'],
            [true, 1, 'bar', 'BAZ'],
            [false, 1, 'foo', 'BAR'],

            [true, 3, 'foo', 'FOO'],
            [true, 3, 'bar', 'BAZ'],
            [true, 3, 'foo', 'BAR'],
        ];
    }
}
