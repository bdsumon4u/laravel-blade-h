<?php

namespace Hotash\BladeH\Builders;

/**
 * Class SelectBuilder
 * @package Hotash\BladeH\Builders
 */
class SelectBuilder
{
    /** @var array|null */
    protected $value;

    /** @var mixed */
    protected $selected;

    /** @var mixed */
    protected $disabled;

    /** @var bool */
    protected $isOpen = false;

    /**
     * Store select-data.
     *
     * @param array|null $value
     * @param array $selected
     * @param array $disabled
     * @throws \Throwable
     */
    public function open($value = null, $selected = [], $disabled = []): void
    {
        throw_if($this->isOpen, 'A select is already open.');

        $this->value = $value;
        $this->selected = $selected;
        $this->disabled = $disabled;
        $this->isOpen = true;
    }

    /**
     * Destroy select-data.
     *
     * @throws \Throwable
     */
    public function close(): void
    {
        throw_unless($this->isOpen, 'No select is open.');
        $this->isOpen = false;
    }

    /**
     * Select data.
     *
     * @return array|null
     */
    public function data()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @param bool $selected
     * @return bool
     */
    public function isSelected(string $value, bool $selected = false): bool
    {
        if ($selected === true) {
            return true;
        }

        if (empty($value)) {
            return false;
        }

        return is_array($this->selected)
            ? in_array($value, $this->selected)
            : $this->selected == $value;
    }

    /**
     * @param string $value
     * @param bool $disabled
     * @return bool
     */
    public function isDisabled(string $value, bool $disabled = false): bool
    {
        if ($disabled === true) {
            return true;
        }

        if (empty($value)) {
            return false;
        }

        return is_array($this->disabled)
            ? in_array($value, $this->disabled)
            : $this->disabled == $value;
    }
}
