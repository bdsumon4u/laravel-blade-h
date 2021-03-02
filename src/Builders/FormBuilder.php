<?php

namespace Hotash\BladeH\Builders;

/**
 * Class FormBuilder
 * @package Hotash\BladeH\Builders
 */
class FormBuilder
{
    /** @var object|null */
    protected $model;

    /** @var bool */
    protected $isOpen = false;

    /**
     * Store form-data.
     *
     * @param object|null $model
     * @throws \Throwable
     */
    public function open(object $model = null): void
    {
        throw_if($this->isOpen, 'A form is already open.');

        $this->model = $model;
        $this->isOpen = true;
    }

    /**
     * Destroy form-data.
     *
     * @throws \Throwable
     */
    public function close(): void
    {
        throw_unless($this->isOpen, 'No form is open.');

        $this->model = null;
        $this->isOpen = false;
    }

    /**
     * Get form value.
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get(string $name, $default = null)
    {
        return optional($this->model)->{$name} ?: $default;
    }

    /**
     * Get form value.
     *
     * @param string $name
     * @param mixed $explicit
     * @return mixed
     */
    public function value(string $name, $explicit = null)
    {
        return $explicit ?: optional($this->model)->{$name};
    }
}
