<?php

namespace Hotash\BladeH\Components;

use Illuminate\Support\Str;

class Asset extends Component
{
    /** @var string */
    public $url;

    /**
     * Link constructor.
     * @param string $path
     * @param bool $if
     */
    public function __construct(string $path, bool $if = true)
    {
        parent::__construct($if);
        $this->url = asset($path);
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        foreach (['.css', '.js'] as $ext) {
            if (Str::endsWith($this->url, $ext)) {
                return view('blade-h::blade-h.assets'.$ext);
            }
        }

        return '';
    }
}
