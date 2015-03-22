<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Unit\DataMatcher\TypeDataMatcherTest.
 */

namespace Drupal\Tests\rules\Unit\DataMatcher;

use FOD\Instruct\DataMatcher\TypeDataMatcher;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \FOD\Instruct\DataMatcher\TypeDataMatcher
 * @group rules
 */
class StringTypeDataMatcherTest extends PHPUnit_Framework_TestCase {

  /**
   * The condition to be tested.
   *
   * @var \FOD\Instruct\DataMatcher\DataMatcherInterface
   */
  protected $matcher;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
    $this->matcher = TypeDataMatcher::create();
  }

  /**
   * @dataProvider matchesProvider
   */
  public function testMatch($expectedMatchResult, $subject, $object) {
    $this->assertSame($expectedMatchResult, $this->matcher->match($subject, $object));
  }

  public function matchesProvider() {
    return array(
      // integer subject
      array(TRUE, 1, 'integer'),
      array(FALSE, 1, 'string'),

      // string subject
      array(TRUE, '1', 'string'),
      array(FALSE, '1', 'integer'),

      // boolean subject
      array(TRUE, FALSE, 'boolean'),
      array(FALSE, TRUE, 'integer'),

      // array subject
      array(TRUE, array(), 'array'),
      array(FALSE, array('foo'), 'integer'),

      // null subject
      array(TRUE, NULL, 'NULL'),
      array(FALSE, NULL, 'integer'),

      // class subject
      array(TRUE, new \SplQueue(), '\SplQueue'),
      array(FALSE, new \SplQueue(), '\SplStack'),
    );
  }
}
