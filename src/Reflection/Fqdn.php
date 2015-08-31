<?php

namespace FOD\Instruct\Reflection;

use FOD\Instruct\TypeChecker\StringTypeChecker;

final class Fqdn
{
    private $fqdn;

    /**
     * @param string $fqdn
     */
    public function __construct($fqdn)
    {
        StringTypeChecker::scheck($fqdn, 'FQDN');

        $this->fqdn = $fqdn;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->fqdn;
    }

    /**
     * @return Fqdn
     */
    public function trim()
    {
        return new $this(ltrim((string) $this, '\\'));
    }

    /**
     * @param  Fqdn $fqdn
     *
     * @return bool
     */
    public function isEqualTo(Fqdn $fqdn)
    {
        return (string) $this->trim() === (string) $fqdn->trim();
    }
}
