<?php

namespace FOD\Instruct\Tests\Condition;

use FOD\Instruct\Condition\DataMatchesCondition;
use PHPUnit_Framework_TestCase as TestCase;

class DataMatchesTest extends TestCase
{
    public function testInstantiation()
    {
        new DataMatchesCondition();
    }

    /**
     * @dataProvider dataMatchersProvider
     */
    public function testMatchesTypes($subject, $object, $matcherFqdn, $matcherArguments)
    {
        $condition = new DataMatchesCondition();

        $context = $this->prophesize('FOD\Instruct\Context\ContextInterface');

        $context->get('subject')->willReturn($subject);
        $context->get('object')->willReturn($object);
        $context->get('data_matcher_fqdn')->willReturn($matcherFqdn);
        $context->get('data_matcher_arguments', [])->willReturn($matcherArguments ?: []);

        $this->assertTrue($condition->verify($context->reveal()));
    }

    /**
     * Returns a sample of data matchers and subject/object couples.
     *
     * @return array
     */
    public function dataMatchersProvider()
    {
        return [
            [ [1, 2],        1,         'FOD\Instruct\DataMatcher\ArrayContainsDataMatcher',     null ],
            [ [3, 4],        2,         'FOD\Instruct\DataMatcher\ArrayCountDataMatcher',        null ],
            [ [[1, 2], [1]], [1 => 2],  'FOD\Instruct\DataMatcher\ArrayDiffDataMatcher',         null ],
            [ [1, 2],        1,         'FOD\Instruct\DataMatcher\ArrayHasKeyDataMatcher',       null ],
            [ [[1, 2], [1]], [1],       'FOD\Instruct\DataMatcher\ArrayIntersectDataMatcher',    null ],
            [ [[1, 2], [1]], [1, 2],    'FOD\Instruct\DataMatcher\ArrayUnionDataMatcher',        null ],

            [ 'foobar',      'oob',     'FOD\Instruct\DataMatcher\StringContainsDataMatcher',    null ],
            [ 'foo',         'foo',     'FOD\Instruct\DataMatcher\StringEqualsDataMatcher',      null ],
            [ 'bar',         'baz',     'FOD\Instruct\DataMatcher\StringLevenshteinDataMatcher', null ],
            [ 'FOO',         '/foo/i',  'FOD\Instruct\DataMatcher\StringRegexpDataMatcher',      null ],

            [ 1,             'integer', 'FOD\Instruct\DataMatcher\TypeDataMatcher',              null ],
        ];
    }
}
