<?php

namespace Hotash\BladeH\Traits;

use Illuminate\Support\Str;

/**
 * Trait ClassManager
 * @package Hotash\BladeH\Traits
 */
trait ClassManager
{
    /**
     * @var array|string
     */
    protected $class = [];

    /**
     * @param array $merge
     * @return string
     */
    public function class(array $merge = []): string
    {
        $class = is_array($this->class) ? $this->class : [$this->class];

        $class = collect(array_merge($class, $merge))
            ->map(function ($val, $key) {
                if (is_int($key)) {
                    return $val;
                }
                return (bool)$val ? $key : null;
            })->toArray();

        # Convert To A String & Remove Extra Spaces
        return Str::of(implode(' ', $class))
            ->replaceMatches('/\s+/', ' ')
            ->trim();
    }
}
