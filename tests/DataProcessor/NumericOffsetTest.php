<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Unit\Plugin\RulesDataProcessor\TrimTest.
 */

namespace Drupal\Tests\rules\Unit\DataProcessor;

use PHPUnit_Framework_TestCase;
use FOD\Instruct\DataProcessor\NumericOffsetDataProcessor;

/**
 * @coversDefaultClass \FOD\Instruct\DataProcessor\NumericOffsetDataProcessor
 * @group rules
 */
class NumericOffsetTest extends PHPUnit_Framework_TestCase {
  /**
   * @dataProvider stringsProvider
   */
  public function testNumericOffset($expectedMatchResult, $offset, $value) {
    $processor = new NumericOffsetDataProcessor($offset);

    $this->assertSame($expectedMatchResult, $processor->process($value));
  }

  public function stringsProvider() {
    return array(
      array(5, 0, 5),
      array(5, 1, 4),
      array(5, '1', '4'),
      array(5, 1, '4'),
      array(5, '1', 4),
      array(5, '-1', 6),
      array(5, -1, 6),
      array(5.0, -1, 6.0),
    );
  }
}
