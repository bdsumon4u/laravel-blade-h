<?php

namespace Hotash\BladeH\Components\Forms\Inputs;

use Hotash\BladeH\Components\Tags\EmptyTag;
use Hotash\BladeH\Traits\NameManager;
use Illuminate\Support\Str;

/**
 * Class Input
 * @package Hotash\BladeH\Components\Forms\Inputs
 */
class Input extends EmptyTag
{
    use NameManager;

    /** @var string */
    public $type;

    /** @var string */
    public $value;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param bool $if
     * @param array|string $class
     * @param string $key
     * @param string $id
     * @param string $type
     * @param string|null $value
     */
    public function __construct(string $name, $if = true, $class = [], $key = '', $id = '', $type = 'text', $value = null)
    {
        parent::__construct($if, $class);
        $this->name = $name;
        $this->key = $key;
        $this->id = $id;
        $this->type = $type;

        $this->value = $value;
        if ($this->key || !Str::contains($name, '[]')) {
            $this->value = old($this->key(), $this->value);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $prefix = 'blade-h::blade-h.forms.inputs.';
        return view()->exists($prefix.$this->type)
            ? view($prefix.$this->type)
            : view($prefix.'input');
    }

    /**
     * Determine input type.
     *
     * @return string
     */
    public function type(): string
    {
        return $this->componentName === 'input'
            ? $this->type
            : $this->componentName;
    }
}
