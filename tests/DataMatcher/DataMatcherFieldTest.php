<?php

namespace FOD\Instruct\Tests\DataMatcher;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\DataMatcher\DataMatcherField;

class DataMatcherFieldTest extends TestCase
{
    const SUT_FQDN = 'FOD\Instruct\DataMatcher\DataMatcherField';

    public function testInstatiation()
    {
        $fqdn = new DataMatcherField(DataMatcherField::VALUE_BOTH);

        $this->assertInstanceOf(self::SUT_FQDN, $fqdn);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Data matcher field should be an int. 'array (
     * )' given.
     */
    public function testWrongTypeInstatiation()
    {
        new DataMatcherField([]);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Data matcher field value should be one of the followings: 0, 1, 2, 3.
     */
    public function testWrongValueInstatiation()
    {
        new DataMatcherField(PHP_INT_MAX);
    }

    /**
     * @dataProvider subjectDataProvider
     */
    public function testSupportsSubject($expectedSupport, $field)
    {
        $this->assertSame($expectedSupport, (new DataMatcherField($field))->supportsSubject());
    }

    public function subjectDataProvider()
    {
        return [
            [true, DataMatcherField::VALUE_SUBJECT],
            [true, DataMatcherField::VALUE_BOTH],
            [false, DataMatcherField::VALUE_OBJECT],
            [false, DataMatcherField::VALUE_NONE],
        ];
    }

    /**
     * @dataProvider objectDataProvider
     */
    public function testSupportsObject($expectedSupport, $field)
    {
        $this->assertSame($expectedSupport, (new DataMatcherField($field))->supportsObject());
    }

    public function objectDataProvider()
    {
        return [
            [false, DataMatcherField::VALUE_SUBJECT],
            [true, DataMatcherField::VALUE_BOTH],
            [true, DataMatcherField::VALUE_OBJECT],
            [false, DataMatcherField::VALUE_NONE],
        ];
    }
}
