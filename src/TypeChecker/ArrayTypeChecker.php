<?php

namespace FOD\Instruct\TypeChecker;

final class ArrayTypeChecker extends AbstractTypeChecker
{
    /**
     * {@inheritdoc}
     */
    protected function doCheck($value)
    {
        return is_array($value);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTypeName()
    {
        return 'array';
    }
}
