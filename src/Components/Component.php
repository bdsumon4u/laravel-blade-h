<?php

namespace Hotash\BladeH\Components;

use Illuminate\View\Component as IlluminateComponent;

/**
 * Class Component
 * @package Hotash\BladeH\Components
 */
abstract class Component extends IlluminateComponent
{
    /** @var bool */
    protected $if = true;

    /**
     * Component constructor.
     * @param bool $if
     */
    public function __construct(bool $if = true)
    {
        $this->if = $if;
    }

    /**
     * Determine if the component should be rendered.
     *
     * @return bool
     */
    public function shouldRender(): bool
    {
        return $this->if;
    }
}
