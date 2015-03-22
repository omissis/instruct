<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Unit\Plugin\RulesDataProcessor\LowercaseTest.
 */

namespace Drupal\Tests\rules\Unit\DataProcessor;

use PHPUnit_Framework_TestCase;
use FOD\Instruct\DataProcessor\LowercaseDataProcessor;

/**
 * @coversDefaultClass \FOD\Instruct\DataProcessor\LowercaseDataProcessor
 * @group rules
 */
class LowercaseTest extends PHPUnit_Framework_TestCase {
  /**
   * @dataProvider stringsProvider
   */
  public function testTrim($expectedMatchResult, $string) {
    $processor = new LowercaseDataProcessor();

    $this->assertSame($expectedMatchResult, $processor->process($string));
  }

  public function stringsProvider() {
    return array(
      array('foo', 'foo'),
      array('foo', 'FOO'),
      array('foo ', 'fOo '),
    );
  }
}
