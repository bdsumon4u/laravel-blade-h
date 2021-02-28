<?php

namespace Hotash\BladeH\Components\Tags;

use Hotash\BladeH\Components\Component;
use Hotash\BladeH\Traits\ClassManager;

/**
 * Class EmptyTag
 * @package Hotash\BladeH\Components\Tags
 */
class EmptyTag extends Component
{
    use ClassManager;

    /**
     * EmptyTag constructor.
     * @param bool $if
     * @param array|string $class
     */
    public function __construct(bool $if = true, $class = [])
    {
        parent::__construct($if);
        $this->class = $class;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $prefix = 'blade-h::blade-h.tags.';
        return view()->exists($prefix.$this->componentName)
            ? view($prefix.$this->componentName)
            : view($prefix.'empty-tag');
    }
}
