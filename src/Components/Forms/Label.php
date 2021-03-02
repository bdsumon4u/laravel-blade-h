<?php

namespace Hotash\BladeH\Components\Forms;

use Hotash\BladeH\Components\Tags\ContentTag;
use Hotash\BladeH\Traits\NameManager;

/**
 * Class Label
 * @package Hotash\BladeH\Components\Forms
 */
class Label extends ContentTag
{
    use NameManager;

    /**
     * @var bool
     */
    public $for;

    /**
     * @var bool
     */
    public $required;

    /**
     * @var string
     */
    public $text;

    /**
     * Create a new component instance.
     *
     * @param bool $if
     * @param array|string $class
     * @param string $name
     * @param string $for
     * @param string $text
     * @param bool $required
     */
    public function __construct($if = true, $class = [], $for = '', $name = '', $text = '', $required = false)
    {
        parent::__construct($if, $class);

        if (!$this->for = $for) {
            $this->name = $name;
            $this->for = $this->id();
        }

        $this->text = $text;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('blade-h::blade-h.forms.label');
    }

    /**
     * Generate label text.
     *
     * @return string
     */
    public function label(): string
    {
        $text = ucwords(str_replace(['-', '_'], ' ', $this->for));
        return __($this->text ?: $text);
    }
}
