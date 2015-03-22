<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Unit\DataMatcher\Argument\DataMatcherArgumentTest.
 */

namespace Drupal\Tests\rules\Unit\DataMatcher\Argument;

use PHPUnit_Framework_TestCase;
use FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

/**
 * @coversDefaultClass \FOD\Instruct\DataMatcher\Argument\DataMatcherArgument
 * @group rules
 */
class DataMatcherArgumentTest extends PHPUnit_Framework_TestCase {

  /**
   * @dataProvider arraySuccesfulValuesProvider
   */
  public function testSuccesfulCreate($value, $constraint) {
    $argument = new DataMatcherArgument($value, $constraint);

    $this->assertInstanceOf(
      'FOD\Instruct\DataMatcher\Argument\DataMatcherArgument',
      $argument
    );
  }

  /**
   * @dataProvider arrayFailingValuesProvider
   * @expectedException InvalidArgumentException
   * @expcetedExceptionMessage Invalid value, the following violations have been detected:
   */
  public function testFailingCreate($value, $constraint) {
    $argument = new DataMatcherArgument($value, $constraint);
  }

  public function arrayFailingValuesProvider() {
    $stringConstraint = new Type(['type' => 'string']);
    $arrayConstraint = new Type(['type' => 'array']);
    $lengthConstraint = new Length(['min' => 4, 'max' => 6]);

    return [
      [[1], $stringConstraint],
      ["1", $arrayConstraint],
      ["foo", $lengthConstraint],
      ["foo", [$stringConstraint, $lengthConstraint]],
    ];
  }

  public function arraySuccesfulValuesProvider() {
    $stringConstraint = new Type(['type' => 'string']);
    $arrayConstraint = new Type(['type' => 'array']);
    $lengthConstraint = new Length(['min' => 2, 'max' => 4]);

    return [
      [[1], $arrayConstraint],
      ["1", $stringConstraint],
      ["foo", $lengthConstraint],
      ["foo", [$stringConstraint, $lengthConstraint]],
    ];
  }

}
