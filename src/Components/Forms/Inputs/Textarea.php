<?php

namespace Hotash\BladeH\Components\Forms\Inputs;

/**
 * Class Textarea
 * @package Hotash\BladeH\Components\Forms\Inputs
 */
class Textarea extends Input
{
    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param bool $if
     * @param array|string $class
     * @param string $key
     * @param string $id
     * @param string|null $value
     */
    public function __construct(string $name, $if = true, $class = [], $key = '', $id = '', $value = null)
    {
        parent::__construct($name, $if, $class, $key, $id, 'textarea', $value);
    }
}
