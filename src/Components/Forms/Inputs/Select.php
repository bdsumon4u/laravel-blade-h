<?php

namespace Hotash\BladeH\Components\Forms\Inputs;

use Hotash\BladeH\Facades\FormH;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class Select
 * @package Hotash\BladeH\Components\Forms\Inputs
 */
class Select extends Input
{
    /** @var mixed */
    public $selected;

    /** @var mixed */
    public $disabled;

    /** @var bool */
    public $multiple;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param bool $if
     * @param array $class
     * @param string $key
     * @param string $id
     * @param null $value
     * @param $selected
     * @param $disabled
     * @param bool $multiple
     */
    public function __construct(string $name, $if = true, $class = [], $key = '', $id = '', $value = null, $selected = [], $disabled = [], $multiple = false)
    {
        parent::__construct($name, $if, $class, $key, $id, 'select');
        $this->value = $this->extract(FormH::value($name, $value));
        $this->selected = old($this->key(), $selected);
        $this->disabled = $disabled;
        $this->multiple = $multiple || Str::contains($name, '[]');
    }

    /**
     * @param $value
     * @return array
     */
    public function extract($value): array
    {
        if (is_array($value)) {
            if (Arr::isAssoc($value)) {
                return $value;
            }

            return collect($value)
                ->mapWithKeys(function ($value) {
                    return [$value => $value];
                })->toArray();
        }

        return [];
    }

    /**
     * @param $selected
     * @return bool
     */
    public function isSelected($selected): bool
    {
        return is_array($this->selected)
            ? in_array($selected, $this->selected)
            : $this->selected == $selected;
    }

    /**
     * @param $disabled
     * @return bool
     */
    public function isDisabled($disabled): bool
    {
        return is_array($this->disabled)
            ? in_array($disabled, $this->disabled)
            : $this->disabled == $disabled;
    }
}
