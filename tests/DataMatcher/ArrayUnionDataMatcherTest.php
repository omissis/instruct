<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Unit\DataMatcher\ArrayUnionDataMatcherTest.
 */

namespace Drupal\Tests\rules\Unit\DataMatcher;

use FOD\Instruct\DataMatcher\ArrayUnionDataMatcher;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \FOD\Instruct\DataMatcher\ArrayUnionDataMatcher
 * @group rules
 */
class ArrayUnionDataMatcherTest extends PHPUnit_Framework_TestCase {
  /**
   * @dataProvider arrayMatchingValuesProvider
   */
  public function testMatch($subject, $object) {
    $matcher = ArrayUnionDataMatcher::create();

    // The union between subject[0] and subject[1] matches object.
    $this->assertTrue($matcher->match($subject, $object));
  }

  /**
   * @dataProvider arrayNotMatchingValuesProvider
   */
  public function testDontMatch($subject, $object) {
    $matcher = ArrayUnionDataMatcher::create();

    // The union between subject[0] and subject[1] does not match object.
    $this->assertFalse($matcher->match($subject, $object));
  }

  public function arrayMatchingValuesProvider() {
    return [
      [[[1], [1]],                  [1]],
      [[[1, 2], [1]],               [1, 2]],
      [[['a' => 1, 2], [1]],        ['a' => 1, 2]],
      [[['a' => 1, 2], ['b' => 3]], ['a' => 1, 2, 'b' => 3]],
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
