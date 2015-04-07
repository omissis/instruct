<?php

namespace FOD\Instruct;

interface DelegatorInterface
{
    /**
     * Return a new instance of an object's delegate.
     *
     * @param array $configuration
     *
     * @return mixed
     */
    public function createDelegateInstance(array $configuration = array());
}
