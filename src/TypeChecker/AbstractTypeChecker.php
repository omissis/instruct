<?php

namespace FOD\Instruct\TypeChecker;

use InvalidArgumentException;

abstract class AbstractTypeChecker implements TypeCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public function check($value, $name = 'value')
    {
        if (!$this->doCheck($value)) {
            throw new InvalidArgumentException(sprintf(
                "%s should be %s %s. '%s' given.",
                ucfirst($name),
                $this->getTypeNameArticle(),
                $this->getTypeName(),
                trim(var_export($value, true), "'")
            ));
        }
    }

    /**
     * static version of the check method.
     *
     * @param  mixed $value
     *
     * @throws InvalidArgumentException
     *
     * @return null
     */
    public static function scheck($value, $name = 'value')
    {
        return (new static())->check($value, $name);
    }

    /**
     * Perform the actual checks.
     *
     * @param  mixed $value
     *
     * @return bool
     */
    abstract protected function doCheck($value);

    /**
     * Return the type name.
     *
     * @return string
     */
    abstract protected function getTypeName();

    /**
     * Return the type name article.
     *
     * @return string
     */
    protected function getTypeNameArticle()
    {
        return 'an';
    }
}
