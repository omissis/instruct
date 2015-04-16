<?php

namespace FOD\Instruct\Context;


interface ContextInterface
{
    public function get($key, $default = null);
}
