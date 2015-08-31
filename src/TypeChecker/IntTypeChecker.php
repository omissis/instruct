<?php

namespace FOD\Instruct\TypeChecker;

final class IntTypeChecker extends AbstractTypeChecker
{
    /**
     * {@inheritdoc}
     */
    protected function doCheck($value)
    {
        return is_int($value);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTypeName()
    {
        return 'int';
    }
}
