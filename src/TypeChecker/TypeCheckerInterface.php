<?php

namespace FOD\Instruct\TypeChecker;

interface TypeCheckerInterface
{
    /**
     * Checks the given value matches the wanted type.
     *
     * @param  mixed $value
     * @param  string $name  the name of the value
     *
     * @throws InvalidArgumentException
     *
     * @return null
     */
    public function check($value, $name = 'value');
}
