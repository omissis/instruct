<?php

/**
 * @file
 * Contains \FOD\Instruct\DataMatcher\Argument\DataMatcherArgument;
 */
namespace FOD\Instruct\DataMatcher\Argument;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validation;
use InvalidArgumentException;
use ArrayAccess;
use Traversable;

final class DataMatcherArgument {

  /**
   * @var mixed
   */
  private $value;

  public function __construct($value, $constraint = null) {
    $this->validateConstraint($constraint);

    if ($constraint) {
      $validator = Validation::createValidator();
      $violations = $validator->validateValue($value, $constraint);

      if (count($violations)) {
        throw new InvalidArgumentException(sprintf(
          "Invalid value, the following violations have been detected:\n%s.",
          $violations
        ));
      }
    }

    $this->value = $value;
  }

  private function validateConstraint($constraint) {
    if ($constraint instanceof Constraint) {
      return;
    }

    if ($constraint instanceof Traversable) {
      return;
    }

    if ($constraint instanceof ArrayAccess) {
      return;
    }

    if (is_array($constraint)) {
      return;
    }

    if (is_null($constraint)) {
      return;
    }

    $message = <<<MESSAGE
      Given $constraint must be one of the following:
        * Symfony\Component\Validator\Constraint;
        * Traversable;
        * ArrayAccess;
        * array;
        * null.
MESSAGE;

    throw new InvalidArgumentException($message);
  }

  public function getValue() {
    return $this->value;
  }

}
