<?php

namespace Hotash\BladeH\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class SelectH
 * @package Hotash\BladeH\Facades
 */

/**
 * @method static void open($value = null, $selected = [], $disabled = [])
 * @method static void close()
 * @method static array data()
 * @method static bool isSelected(string $value, bool $selected = false)
 * @method static bool isDisabled(string $value, bool $disabled = false)
 *
 * @see \Hotash\BladeH\Builders\SelectBuilder
 */
class SelectH extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'blade-h.select';
    }
}
