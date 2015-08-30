<?php

namespace FOD\Instruct\Reflection;

use InvalidArgumentException;

final class Fqdn
{
    private $fqdn;

    /**
     * @param string $fqdn
     */
    public function __construct($fqdn)
    {
        if (!is_string($fqdn)) {
            throw new InvalidArgumentException(sprintf(
                "FQDN should be a string. '%s' given.",
                var_export($fqdn, true)
            ));
        }

        $this->fqdn = $fqdn;
    }

    public function __toString()
    {
        return $this->fqdn;
    }

    public function trim()
    {
        return new $this(ltrim((string) $this, '\\'));
    }

    public function isEqualTo(Fqdn $fqdn)
    {
        return (string) $this->trim() === (string) $fqdn->trim();
    }
}
