<?php

namespace FOD\Instruct\TypeChecker;

use InvalidArgumentException;

final class StringTypeChecker extends AbstractTypeChecker
{
    /**
     * {@inheritdoc}
     */
    protected function doCheck($value)
    {
        return is_string($value);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTypeName()
    {
        return 'string';
    }

    /**
     * {@inheritdoc}
     */
    protected function getTypeNameArticle()
    {
        return 'a';
    }
}
