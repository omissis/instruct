<?php

namespace FOD\Instruct\Tests\Reflection;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\Reflection\Fqdn;

class FqdnTest extends TestCase
{
    const TEST_FQDN = '\\Foo\\Bar';
    const SUT_FQDN = 'FOD\Instruct\Reflection\Fqdn';

    public function testEmptyInstatiation()
    {
        $fqdn = new Fqdn('');

        $this->assertInstanceOf(self::SUT_FQDN, $fqdn);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage FQDN should be a string. 'array (
     * )' given.
     */
    public function testWrongTypeInstatiation()
    {
        new Fqdn([]);
    }

    public function testCanConverToString()
    {
        $fqdn = new Fqdn(self::TEST_FQDN);

        $this->assertSame(self::TEST_FQDN, (string)$fqdn);
    }

    public function testGetTrimmedFqdn()
    {
        $fqdn = new Fqdn(self::TEST_FQDN);

        $this->assertInstanceOf(self::SUT_FQDN, $fqdn->trim());
        $this->assertEquals(new Fqdn('Foo\\Bar'), $fqdn->trim());
    }

    /**
     * @dataProvider fqdnProvider
     */
    public function testComparison($expectedEquality, $fqdn1, $fqdn2)
    {
        $this->assertSame($expectedEquality, (new Fqdn($fqdn1))->isEqualTo(new Fqdn($fqdn2)));
    }

    public function fqdnProvider()
    {
        return [
            [ true,  self::TEST_FQDN, 'Foo\\Bar' ],
            [ true,  self::TEST_FQDN, self::TEST_FQDN ],
            [ false, self::TEST_FQDN, self::TEST_FQDN . '\\Baz' ],
        ];
    }
}
