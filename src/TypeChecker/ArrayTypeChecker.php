<?php

namespace FOD\Instruct\TypeChecker;

use InvalidArgumentException;

final class ArrayTypeChecker implements TypeCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public static function check($value, $name = 'value')
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException(sprintf(
                "%s should be an array. '%s' given.",
                ucfirst($name),
                var_export($value, true)
            ));
        }
    }
}
