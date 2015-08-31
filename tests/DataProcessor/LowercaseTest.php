<?php

namespace FOD\Instruct\Tests\DataProcessor;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\DataProcessor\LowercaseDataProcessor;

class LowercaseTest extends TestCase
{
    /**
     * @dataProvider stringsProvider
     */
    public function testTrim($expectedMatchResult, $string)
    {
        $processor = new LowercaseDataProcessor();

        $this->assertSame($expectedMatchResult, $processor->process($string));
    }

    public function stringsProvider()
    {
        return [
            ['foo', 'foo'],
            ['foo', 'FOO'],
            ['foo ', 'fOo '],
        ];
    }
}
