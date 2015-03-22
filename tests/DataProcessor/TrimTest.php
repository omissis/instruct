<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Unit\Plugin\RulesDataProcessor\TrimTest.
 */

namespace Drupal\Tests\rules\Unit\DataProcessor;

use PHPUnit_Framework_TestCase;
use FOD\Instruct\DataProcessor\TrimDataProcessor;

/**
 * @coversDefaultClass \FOD\Instruct\DataProcessor\TrimDataProcessor
 * @group rules
 */
class TrimTest extends PHPUnit_Framework_TestCase {
  /**
   * @dataProvider stringsProvider
   */
  public function testTrim($expectedMatchResult, $string) {
    $processor = new TrimDataProcessor();

    $this->assertSame($expectedMatchResult, $processor->process($string));
  }

  public function stringsProvider() {
    return array(
      array('foo', 'foo'),
      array('foo', ' foo'),
      array('foo', 'foo '),
      array('foo', ' foo '),
      array('foo bar', ' foo bar '),
    );
  }
}
