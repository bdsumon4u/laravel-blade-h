<?php

namespace Hotash\BladeH\Components\Tags;

use Hotash\BladeH\Components\Component;

/**
 * Class EmptyTag
 * @package Hotash\BladeH\Components\Tags
 */
class EmptyTag extends Component
{
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
