<?php

namespace Hotash\BladeH\Components\Forms\Inputs;

use Hotash\BladeH\Components\Component;
use Hotash\BladeH\Facades\SelectH;

/**
 * Class Option
 * @package Hotash\BladeH\Components\Forms\Inputs
 */
class Option extends Component
{
    /** @var mixed */
    public $value;

    /** @var string */
    public $text;

    /** @var bool */
    public $selected;

    /** @var bool */
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @param bool $if
     * @param string $value
     * @param string $text
     * @param bool $selected
     * @param bool $disabled
     */
    public function __construct($if = true, string $value = '', string $text = '', bool $selected = false, bool $disabled = false)
    {
        parent::__construct($if);
        $this->value = $value;
        $this->text = $text;
        $this->selected = SelectH::isSelected($this->value, $selected);
        $this->disabled = SelectH::isDisabled($this->value, $disabled);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('blade-h::blade-h.forms.inputs.option');
    }
}
