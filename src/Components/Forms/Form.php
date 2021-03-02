<?php

namespace Hotash\BladeH\Components\Forms;

use Hotash\BladeH\Components\Tags\ContentTag;
use Hotash\BladeH\Facades\FormH;

/**
 * Class Form
 * @package Hotash\BladeH\Components\Forms
 */
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
     * @param object|null $model
     * @param string $method
     * @param bool $multipart
     */
    public function __construct($if = true, $class = [], object $model = null, $method = 'GET', $multipart = false)
    {
        parent::__construct($if, $class);
        FormH::open($model);
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

    /**
     * Destroy the form.
     */
    public function destroy()
    {
        FormH::close();
    }
}
