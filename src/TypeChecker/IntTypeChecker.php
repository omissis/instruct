<?php

namespace FOD\Instruct\TypeChecker;

use InvalidArgumentException;

final class IntTypeChecker implements TypeCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public static function check($value, $name = 'value')
    {
        if (!is_int($value)) {
            throw new InvalidArgumentException(sprintf(
                "%s should be an integer. '%s' given.",
                ucfirst($name),
                var_export($value, true)
            ));
        }
    }
}
