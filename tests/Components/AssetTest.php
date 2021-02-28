<?php

namespace Tests\Components;

class AssetTest extends ComponentTestCase
{
    /** @test */
    public function can_be_hidden(): void
    {
        $this->assertComponentRenders(
            '',
            '<H:asset :if="true == false" path="hotash-planet" />'
        );
    }

    /** @test */
    public function can_render_css_asset(): void
    {
        $this->assertComponentRenders(
            '<link rel="stylesheet" href="http://localhost/css/app.css">',
            '<H:asset path="css/app.css" />'
        );
    }

    /** @test */
    public function can_render_js_asset(): void
    {
        $this->assertComponentRenders(
            '<script src="http://localhost/js/app.js"></script>',
            '<H:asset path="js/app.js" />'
        );
    }

    /** @test */
    public function can_render_css_link(): void
    {
        $this->assertComponentRenders(
            '<link rel="stylesheet" href="http://css.test/app.css">',
            '<H:asset path="http://css.test/app.css" />'
        );
    }

    /** @test */
    public function can_render_js_link(): void
    {
        $this->assertComponentRenders(
            '<script src="http://js.test/app.js"></script>',
            '<H:asset path="http://js.test/app.js" />'
        );
    }

    /** @test */
    public function can_accept_custom_attribute(): void
    {
        $this->assertComponentRenders(
            '<link rel="icon" href="http://css.test/app.css">',
            '<H:asset rel="icon" path="http://css.test/app.css" />'
        );

        $this->assertComponentRenders(
            '<script src="http://js.test/app.js" defer="defer"></script>',
            '<H:asset defer path="http://js.test/app.js" />');
    }
}
