<?php

namespace Drupal\Tests\rules\Unit\DataProcessor;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\DataProcessor\TrimDataProcessor;

class TrimTest extends TestCase
{
    /**
     * @dataProvider stringsProvider
     */
    public function testTrim($expectedMatchResult, $string)
    {
        $processor = new TrimDataProcessor();

        $this->assertSame($expectedMatchResult, $processor->process($string));
    }

    public function stringsProvider()
    {
        return [
            ['foo', 'foo'],
            ['foo', ' foo'],
            ['foo', 'foo '],
            ['foo', ' foo '],
            ['foo bar', ' foo bar '],
        ];
    }
}
