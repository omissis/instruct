<?php

namespace Drupal\Tests\rules\Unit\DataProcessor;

use PHPUnit_Framework_TestCase as TestCase;

use FOD\Instruct\DataProcessor\NumericOffsetDataProcessor;

class NumericOffsetTest extends TestCase
{
    /**
     * @dataProvider stringsProvider
     */
    public function testNumericOffset($expectedMatchResult, $offset, $value)
    {
        $processor = new NumericOffsetDataProcessor($offset);

        $this->assertSame($expectedMatchResult, $processor->process($value));
    }

    public function stringsProvider()
    {
        return [
            [5, 0, 5],
            [5, 1, 4],
            [5, '1', '4'],
            [5, 1, '4'],
            [5, '1', 4],
            [5, '-1', 6],
            [5, -1, 6],
            [5.0, -1, 6.0],
        ];
    }
}
