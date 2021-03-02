<?php

namespace Hotash\BladeH\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class BladeH
 * @package Hotash\BladeH\Facades
 */

/**
 * @method static void open(object $model = null)
 * @method static void close()
 * @method static mixed value(string $name, mixed $explicit = null)
 *
 * @see \Hotash\BladeH\Builders\FormBuilder
 */
class FormH extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'blade-h.form';
    }
}
