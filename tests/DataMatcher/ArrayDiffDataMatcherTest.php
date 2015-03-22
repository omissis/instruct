<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Unit\DataMatcher\ArrayDiffDataMatcherTest.
 */

namespace Drupal\Tests\rules\Unit\DataMatcher;

use FOD\Instruct\DataMatcher\ArrayDiffDataMatcher;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \FOD\Instruct\DataMatcher\ArrayDiffDataMatcher
 * @group rules
 */
class ArrayDiffDataMatcherTest extends PHPUnit_Framework_TestCase {
  /**
   * @dataProvider arrayMatchingValuesProvider
   */
  public function testMatch($subject, $object) {
    $matcher = ArrayDiffDataMatcher::create();

    // The diff between subject[0] and subject[1] matches object.
    $this->assertTrue($matcher->match($subject, $object));
  }

  /**
   * @dataProvider arrayNotMatchingValuesProvider
   */
  public function testDontMatch($subject, $object) {
    $matcher = ArrayDiffDataMatcher::create();

    // The diff between subject[0] and subject[1] does not match object.
    $this->assertFalse($matcher->match($subject, $object));
  }

  public function arrayMatchingValuesProvider() {
    return [
      [[[1], [1]],           []],
      [[[1, 2], [1]],        [1 => 2]],
      [[['a' => 1, 2], [1]], [2]],
    ];
  }

  public function arrayNotMatchingValuesProvider() {
    return [
      [[[1], [2]],             [2]],
      [[[2, 3], [1]],          [1]],
      [[[1 => 'a', 'b'], [2]], [2]],
    ];
  }
}
