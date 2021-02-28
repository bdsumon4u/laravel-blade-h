<?php

namespace Hotash\BladeH\Components\Tags;

use Hotash\BladeH\Components\Component;
use Hotash\BladeH\Traits\ClassManager;

/**
 * Class ContentTag
 * @package Hotash\BladeH\Components\Tags
 */
class ContentTag extends Component
{
    use ClassManager;

    /**
     * ContentTag constructor.
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
            : view($prefix.'content-tag');
    }
}
