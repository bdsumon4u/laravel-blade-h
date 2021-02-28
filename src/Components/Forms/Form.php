<?php

namespace Hotash\BladeH\Components\Forms;

use Hotash\BladeH\Components\Tags\ContentTag;

class Form extends ContentTag
{
    /**
     * @var string
     */
    public $method;

    /**
     * @var bool
     */
    public $multipart;

    /**
     * Create a new component instance.
     *
     * @param bool $if
     * @param array $class
     * @param string $method
     * @param bool $multipart
     */
    public function __construct($if = true, $class = [], $method = 'GET', $multipart = false)
    {
        parent::__construct($if, $class);
        $this->method = strtoupper($method);
        $this->multipart = $multipart;
    }

    /**
     * @return string
     */
    public function enctype(): string
    {
        return $this->method !== 'GET' && $this->multipart
            ? 'multipart/form-data'
            : 'application/x-www-form-urlencoded';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('blade-h::blade-h.forms.form');
    }
}
