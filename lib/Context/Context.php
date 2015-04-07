<?php

namespace FOD\Instruct\Context;

class Context implements ContextInterface
{
    private $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function get($key, $default = null)
    {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }
}
