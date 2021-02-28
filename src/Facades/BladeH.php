<?php

namespace Hotash\BladeH\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class BladeH
 * @package Hotash\BladeH\Facades
 */
class BladeH extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'blade-h';
    }
}
