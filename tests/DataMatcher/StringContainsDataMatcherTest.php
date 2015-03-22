<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Unit\DataMatcher\ContainsDataMatcherTest.
 */

namespace Drupal\Tests\rules\Unit\DataMatcher;

use FOD\Instruct\DataMatcher\StringContainsDataMatcher;
use FOD\Instruct\DataMatcher\DataMatcherInterface;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \FOD\Instruct\DataMatcher\StringContainsDataMatcher
 * @group rules
 */
class StringContainsDataMatcherTest extends PHPUnit_Framework_TestCase {
  /**
   * @expectedException InvalidArgumentException
   * @expectedExceptionMessage Argument "$fields" should be of type int.
   */
  public function testSetCaseSensitive() {
    $matcher = StringContainsDataMatcher::create();

    $matcher->setCaseSensitive('foo');
  }

  /**
   * @dataProvider caseSensitiveMatchesProvider
   */
  public function testCaseSensitiveMatch($expectedMatchResult, $subject, $object) {
    $matcher = StringContainsDataMatcher::create();

    $matcher->setCaseSensitive();

    $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
  }

  /**
   * @dataProvider caseInsensitiveMatchesProvider
   */
  public function testCaseInsensitiveMatch($expectedMatchResult, $subject, $object) {
    $matcher = StringContainsDataMatcher::create();

    $matcher->setCaseInsensitive();

    $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
  }

  public function caseSensitiveMatchesProvider() {
    return array(
      array(TRUE, 'foo', 'foo'),
      array(TRUE, 'foobar', 'oob'),
      array(TRUE, 'foobarfoobar', 'foo'),

      array(FALSE, 'foo', 'FOO'),
      array(FALSE, 'foobar', 'OOB'),
      array(FALSE, 'foobarfoobar', 'FOO'),
    );
  }

  public function caseInsensitiveMatchesProvider() {
    return array(
      array(TRUE, 'foo', 'foo'),
      array(TRUE, 'foobar', 'oob'),
      array(TRUE, 'foobarfoobar', 'foo'),

      array(TRUE, 'foo', 'FOO'),
      array(TRUE, 'foobar', 'OOB'),
      array(TRUE, 'foobarfoobar', 'FOO'),
    );
  }
}
