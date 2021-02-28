<?php

namespace Hotash\BladeH\Components\Tags;

/**
 * Class AnchorTag
 * @package Hotash\BladeH\Components\Tags
 */
class AnchorTag extends ContentTag
{
    /** @var string */
    public $href;

    /** @var string */
    public $label;

    /**
     * AnchorTag constructor.
     * @param bool $if
     * @param array|string $class
     * @param string $href
     * @param string $route
     * @param string $label
     */
    public function __construct(bool $if = true, $class = [], string $href = '', string $route = '', string $label = '')
    {
        parent::__construct($if, $class);

        if (empty($this->href = $href) && !empty($route)) {
            $this->href = route($route);
        }

        $this->label = __($label);
        if (empty($this->label)) {
            $this->label = $this->href ?: 'Click Here';
        }
    }
}
