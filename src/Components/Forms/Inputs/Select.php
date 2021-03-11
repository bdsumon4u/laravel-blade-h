<?php

namespace Hotash\BladeH\Components\Forms\Inputs;

use Hotash\BladeH\Facades\FormH;
use Hotash\BladeH\Facades\SelectH;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class Select
 * @package Hotash\BladeH\Components\Forms\Inputs
 */
class Select extends Input
{
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
     * @param string $type
     * @param array $value
     * @param mixed $selected
     * @param mixed $disabled
     * @param bool $multiple
     */
    public function __construct(string $name, $if = true, $class = [], $key = '', $id = '', $type = 'select', $value = null, $selected = [], $disabled = [], $multiple = false)
    {
        parent::__construct($name, $if, $class, $key, $id, $type);
        $value = $this->extract(FormH::value($name, $value));
        SelectH::open($value, old($this->key(), $selected), $disabled);
        $this->multiple = $multiple || Str::contains($name, '[]');
    }

    /**
     * @param $value
     * @return array
     */
    public function extract($value)
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
     * Destroy the select.
     */
    public function destroy()
    {
        SelectH::close();
    }
}
