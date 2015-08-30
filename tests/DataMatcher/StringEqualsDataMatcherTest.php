<?php

namespace Drupal\Tests\rules\Unit\DataMatcher;

use FOD\Instruct\DataMatcher\StringEqualsDataMatcher;

use PHPUnit_Framework_TestCase as TestCase;

class StringEqualsDataMatcherTest extends TestCase
{
    /**
     * @dataProvider caseSensitiveTrimmedMatchesProvider
     */
    public function testCaseSensitiveTrimmedMatch($expectedMatchResult, $subject, $object)
    {
        $matcher = StringEqualsDataMatcher::create();

        $matcher->setCaseSensitive();

        $matcher->setTrimmed();

        $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
    }

    /**
     * @dataProvider caseInsensitiveTrimmedMatchesProvider
     */
    public function testCaseInsensitiveTrimmedMatch($expectedMatchResult, $subject, $object)
    {
        $matcher = StringEqualsDataMatcher::create();

        $matcher->setCaseInsensitive();

        $matcher->setTrimmed();

        $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
    }

    /**
     * @dataProvider caseSensitiveUntrimmedMatchesProvider
     */
    public function testCaseSensitiveUntrimmedMatch($expectedMatchResult, $subject, $object)
    {
        $matcher = StringEqualsDataMatcher::create();

        $matcher->setCaseSensitive();

        $matcher->unsetTrimmed();

        $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
    }

    /**
     * @dataProvider caseInsensitiveUntrimmedMatchesProvider
     */
    public function testCaseInsensitiveUntrimmedMatch($expectedMatchResult, $subject, $object)
    {
        $matcher = StringEqualsDataMatcher::create();

        $matcher->setCaseInsensitive();

        $matcher->unsetTrimmed();

        $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
    }

    public function caseSensitiveTrimmedMatchesProvider()
    {
        return [
            [true,  'foo ', ' foo'],
            [true,  'foo',  'foo'],
            [false, 'foo ', ' FOO'],
            [false, 'foo ', ' fo'],
            [false, 'foo',  'FOO'],
            [false, 'foo ', ' FO'],
            [false, 'foo',  'fo'],
        ];
    }

    public function caseInsensitiveTrimmedMatchesProvider()
    {
        return [
            [true,  'foo ', ' foo'],
            [true,  'foo',  'foo'],
            [true,  'foo ', ' FOO'],
            [false, 'foo ', ' fo'],
            [true,  'foo',  'FOO'],
            [false, 'foo ', ' FO'],
            [false, 'foo',  'fo'],
        ];
    }

    public function caseSensitiveUntrimmedMatchesProvider()
    {
        return [
            [false, 'foo ', ' foo'],
            [true,  'foo',  'foo'],
            [false, 'foo ', ' FOO'],
            [false, 'foo ', ' fo'],
            [false, 'foo',  'FOO'],
            [false, 'foo ', ' FO'],
            [false, 'foo',  'fo'],
        ];
    }

    public function caseInsensitiveUntrimmedMatchesProvider()
    {
        return [
            [false, 'foo ', ' foo'],
            [true,  'foo',  'foo'],
            [false, 'foo ', ' FOO'],
            [false, 'foo ', ' fo'],
            [true,  'foo',  'FOO'],
            [false, 'foo ', ' FO'],
            [false, 'foo',  'fo'],
        ];
    }
}
