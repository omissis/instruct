<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Unit\DataMatcher\ArrayContainsDataMatcherTest.
 */

namespace Drupal\Tests\rules\Unit\DataMatcher;

use FOD\Instruct\DataMatcher\ArrayContainsDataMatcher;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \FOD\Instruct\DataMatcher\ArrayContainsDataMatcher
 * @group rules
 */
class ArrayContainsDataMatcherTest extends PHPUnit_Framework_TestCase {
  /**
   * @dataProvider arrayValuesProvider
   */
  public function testMatch($expectedMatchResult, $subject, $object) {
    $matcher = ArrayContainsDataMatcher::create();

    $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
  }

  public function arrayValuesProvider() {
    return array(
      array(TRUE, [1],        1),
      array(TRUE, [1, 2],     1),
      array(TRUE, ['a' => 1], 1),

      array(FALSE, [2],        1),
      array(FALSE, [2, 3],     1),
      array(FALSE, [1 => 'a'], 1),
    );
  }
}
