<?php

namespace Tests\Components;

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
}
