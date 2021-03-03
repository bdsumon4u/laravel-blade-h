<?php

namespace Hotash\BladeH\Components\Forms\Inputs;

use Hotash\BladeH\Facades\FormH;
use Illuminate\Support\Str;

class Checkable extends Input
{
    /**
     * @var bool $checked
     */
    public $checked;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param bool $if
     * @param array|string $class
     * @param string $key
     * @param string $id
     * @param string $type
     * @param string $value
     * @param mixed $checked
     */
    public function __construct(string $name, $if = true, $class = [], $key = '', $id = '', $type = 'checkable', $value = '', $checked = false)
    {
        parent::__construct($name, $if, $class, $key, $id, $type);

        $this->value = $value;
        $checked === 'checked' && $checked = true;
        $checked = FormH::value($name, $checked);

        $this->checked = old($this->key(), $checked);
        if ($this->checked !== true) {
            $this->checked = is_array($this->checked)
                ? in_array($value, $this->checked)
                : $value == $this->checked;
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
            : view($prefix.'checkable');
    }

    /**
     * Determine input type.
     *
     * @return string
     */
    public function type(): string
    {
        return $this->type === 'checkable'
            ? $this->componentName
            : $this->type;
    }

    /**
     * Generates id attribute.
     *
     * @return string
     */
    public function id(): string
    {
        return parent::id().'-'.str_replace(' _', '-', strtolower($this->value));
    }
}
