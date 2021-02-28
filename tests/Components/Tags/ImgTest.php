<?php

namespace Tests\Components\Tags;

use Tests\Components\ComponentTestCase;

class ImgTest extends ComponentTestCase
{
    /** @test */
    public function can_be_rendered(): void
    {
        $this->assertComponentRenders(
            '<img class="" src="http://localhost/">',
            '<H:img src="" />'
        );
    }

    /** @test */
    public function can_be_hidden(): void
    {
        $this->assertComponentRenders(
            '',
            '<H:img :if="true == false" src="" />'
        );
    }

    /** @test */
    public function can_accept_custom_attribute(): void
    {
        $this->assertComponentRenders(
            '<img class="" src="http://localhost/asset-path" id="avatar">',
            '<H:img src="asset-path" id="avatar" />'
        );
    }

    /** @test */
    public function class_can_be_added()
    {
        $this->assertComponentRenders(
            '<img class="twinkle twinkle little star" src="http://localhost/asset-path" id="avatar">',
            '<H:img src="asset-path" id="avatar" class="twinkle twinkle little star" />'
        );
    }

    /** @test */
    public function class_can_be_passed_as_array()
    {
        $this->assertComponentRenders(
            '<img class="hotash planet" src="http://localhost/asset-path" id="avatar">',
            '<H:img src="asset-path" id="avatar" :class="[\'hotash\', \'planet\']" />'
        );
    }
}
