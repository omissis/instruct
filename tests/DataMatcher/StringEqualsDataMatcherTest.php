<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Unit\DataMatcher\StringEqualsDataMatcherTest.
 */

namespace Drupal\Tests\rules\Unit\DataMatcher;

use FOD\Instruct\DataMatcher\StringEqualsDataMatcher;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \FOD\Instruct\DataMatcher\StringEqualsDataMatcher
 * @group rules
 */
class StringEqualsDataMatcherTest extends PHPUnit_Framework_TestCase {

  /**
   * @dataProvider caseSensitiveTrimmedMatchesProvider
   */
  public function testCaseSensitiveTrimmedMatch($expectedMatchResult, $subject, $object) {
    $matcher = StringEqualsDataMatcher::create();

    $matcher->setCaseSensitive();

    $matcher->setTrimmed();

    $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
  }

  /**
   * @dataProvider caseInsensitiveTrimmedMatchesProvider
   */
  public function testCaseInsensitiveTrimmedMatch($expectedMatchResult, $subject, $object) {
    $matcher = StringEqualsDataMatcher::create();

    $matcher->setCaseInsensitive();

    $matcher->setTrimmed();

    $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
  }

  /**
   * @dataProvider caseSensitiveUntrimmedMatchesProvider
   */
  public function testCaseSensitiveUntrimmedMatch($expectedMatchResult, $subject, $object) {
    $matcher = StringEqualsDataMatcher::create();

    $matcher->setCaseSensitive();

    $matcher->unsetTrimmed();

    $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
  }

  /**
   * @dataProvider caseInsensitiveUntrimmedMatchesProvider
   */
  public function testCaseInsensitiveUntrimmedMatch($expectedMatchResult, $subject, $object) {
    $matcher = StringEqualsDataMatcher::create();

    $matcher->setCaseInsensitive();

    $matcher->unsetTrimmed();

    $this->assertSame($expectedMatchResult, $matcher->match($subject, $object));
  }

  public function caseSensitiveTrimmedMatchesProvider() {
    return array(
      array(TRUE,  'foo ', ' foo'),
      array(TRUE,  'foo',  'foo'),
      array(FALSE, 'foo ', ' FOO'),
      array(FALSE, 'foo ', ' fo'),
      array(FALSE, 'foo',  'FOO'),
      array(FALSE, 'foo ', ' FO'),
      array(FALSE, 'foo',  'fo'),
    );
  }

  public function caseInsensitiveTrimmedMatchesProvider() {
    return array(
      array(TRUE,  'foo ', ' foo'),
      array(TRUE,  'foo',  'foo'),
      array(TRUE,  'foo ', ' FOO'),
      array(FALSE, 'foo ', ' fo'),
      array(TRUE,  'foo',  'FOO'),
      array(FALSE, 'foo ', ' FO'),
      array(FALSE, 'foo',  'fo'),
    );
  }

  public function caseSensitiveUntrimmedMatchesProvider() {
    return array(
      array(FALSE, 'foo ', ' foo'),
      array(TRUE,  'foo',  'foo'),
      array(FALSE, 'foo ', ' FOO'),
      array(FALSE, 'foo ', ' fo'),
      array(FALSE, 'foo',  'FOO'),
      array(FALSE, 'foo ', ' FO'),
      array(FALSE, 'foo',  'fo'),
    );
  }

  public function caseInsensitiveUntrimmedMatchesProvider() {
    return array(
      array(FALSE, 'foo ', ' foo'),
      array(TRUE,  'foo',  'foo'),
      array(FALSE, 'foo ', ' FOO'),
      array(FALSE, 'foo ', ' fo'),
      array(TRUE,  'foo',  'FOO'),
      array(FALSE, 'foo ', ' FO'),
      array(FALSE, 'foo',  'fo'),
    );
  }

}
