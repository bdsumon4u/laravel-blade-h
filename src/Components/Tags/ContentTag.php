<?php

namespace Hotash\BladeH\Components\Tags;

use Hotash\BladeH\Components\Component;

/**
 * Class ContentTag
 * @package Hotash\BladeH\Components\Tags
 */
class ContentTag extends Component
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
            : view($prefix.'content-tag');
    }
}
