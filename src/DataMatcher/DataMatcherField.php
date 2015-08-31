<?php

namespace FOD\Instruct\DataMatcher;

use FOD\Instruct\TypeChecker\IntTypeChecker;

use InvalidArgumentException;

final class DataMatcherField
{
    const VALUE_NONE    = 0;
    const VALUE_SUBJECT = 1;
    const VALUE_OBJECT  = 2;
    const VALUE_BOTH    = 3;

    /**
     * @var int
     */
    private $dataMatcherField;

    /**
     * @param int $dataMatcherField
     */
    public function __construct($dataMatcherField)
    {
        $values = [
            self::VALUE_NONE,
            self::VALUE_SUBJECT,
            self::VALUE_OBJECT,
            self::VALUE_BOTH,
        ];

        IntTypeChecker::check($dataMatcherField, 'Data matcher field');

        if (!in_array($dataMatcherField, $values, true)) {
            throw new InvalidArgumentException(sprintf(
                "Data matcher field value should be one of the followings: %s.",
                implode(', ', $values)
            ));
        }

        $this->dataMatcherField = $dataMatcherField;
    }

    /**
     * @return bool
     */
    public function supportsSubject()
    {
        return in_array($this->dataMatcherField, [self::VALUE_SUBJECT, self::VALUE_BOTH], true);
    }

    /**
     * @return bool
     */
    public function supportsObject()
    {
        return in_array($this->dataMatcherField, [self::VALUE_OBJECT, self::VALUE_BOTH], true);
    }
}
