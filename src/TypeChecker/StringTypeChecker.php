<?php

namespace FOD\Instruct\TypeChecker;

use InvalidArgumentException;

final class StringTypeChecker implements TypeCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public static function check($value, $name = 'value')
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException(sprintf(
                "%s should be a string. '%s' given.",
                ucfirst($name),
                var_export($value, true)
            ));
        }
    }
}
