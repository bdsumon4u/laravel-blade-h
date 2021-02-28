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
     */
    public function __construct(string $src, bool $if = true)
    {
        parent::__construct($if);
        $this->src = asset($src);
    }
}
