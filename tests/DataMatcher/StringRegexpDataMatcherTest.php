<?php

namespace FOD\Instruct\Tests\DataMatcher;

use FOD\Instruct\DataMatcher\StringRegexpDataMatcher;

use PHPUnit_Framework_TestCase as TestCase;

class StringRegexpDataMatcherTest extends TestCase
{
    /**
     * The condition to be tested.
     *
     * @var \FOD\Instruct\DataMatcher\DataMatcherInterface
     */
    protected $matcher;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->matcher = StringRegexpDataMatcher::create();
    }

    /**
     * @dataProvider matchesProvider
     */
    public function testMatch($expectedMatchResult, $subject, $object)
    {
        $this->assertSame($expectedMatchResult, $this->matcher->match($subject, $object));
    }

    public function matchesProvider()
    {
        return [
            [true, 'foo', '/^foo$/'],
            [true, 'FOO', '/foo/i'],
            [true, 'BAR FOO BAZ', '/foo/i'],

            [false, 'foobar', '/^bar/'],
            [false, 'BARBAZ', '/bar$/i'],
            [false, 'foobar', '/^bar$/i'],
        ];
    }
}
