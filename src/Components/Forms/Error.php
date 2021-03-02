<?php

namespace Hotash\BladeH\Components\Forms;

use Hotash\BladeH\Components\Tags\ContentTag;
use Hotash\BladeH\Traits\NameManager;
use Illuminate\Support\ViewErrorBag;

/**
 * Class Error
 * @package Hotash\BladeH\Components\Forms
 */
class Error extends ContentTag
{
    use NameManager;

    /**
     * @var string
     */
    public $bag;

    /**
     * Create a new component instance.
     *
     * @param bool $if
     * @param array|string $class
     * @param string $key
     * @param string $name
     * @param string $bag
     */
    public function __construct($if = true, $class = [], $key = '', $name = '', $bag = 'default')
    {
        parent::__construct($if, $class);
        $this->key = $key;
        $this->name = $name;
        $this->bag = $bag;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('blade-h::blade-h.forms.error');
    }

    /**
     * @param ViewErrorBag $errors
     * @return array
     */
    public function messages(ViewErrorBag $errors): array
    {
        $bag = $errors->getBag($this->bag);
        return $bag->has($this->key()) ? $bag->get($this->key()) : [];
    }
}
