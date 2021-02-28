<?php

namespace Hotash\BladeH\Components\Tags;

/**
 * Class ImgTag
 * @package Hotash\BladeH\Components\Tags
 */
class ImgTag extends EmptyTag
{
    /** @var string */
    public $src;

    /**
     * ImgTag constructor.
     * @param string $src
     * @param bool $if
     * @param array|string $class
     */
    public function __construct(string $src, bool $if = true, $class = [])
    {
        parent::__construct($if, $class);
        $this->src = asset($src);
    }
}
