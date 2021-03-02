<?php

namespace Hotash\BladeH\Traits;

use Illuminate\Support\Str;

/**
 * Trait NameManager
 * @package Hotash\BladeH\Traits
 */
trait NameManager
{
    /** @var string */
    public $name;

    /** @var string */
    protected $old;

    /** @var string */
    protected $id;

    /**
     * @return string
     */
    public function old(): string
    {
        if ($this->old) {
            return $this->old;
        }

        return $this->old
            = Str::containsAll($this->name, ['[', ']'])
            ? Str::of($this->name)
                ->replace('[]', '.*.')
                ->replace(['][', '[', ']'], '.')
                ->replaceMatches('/\.+/', '.')
                ->rtrim('.*')
            : $this->name;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        if ($this->id) {
            return $this->id;
        }

        return $this->id = Str::of($this->old())
            ->replaceMatches('/[._]/', '-')
            ->replace('*', '');
    }
}
