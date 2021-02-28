<?php

namespace Tests\Components;

use Illuminate\Support\Facades\Route;

class AnchorTest extends ComponentTestCase
{
    /** @test */
    public function can_be_rendered(): void
    {
        $expected = <<<'HTML'
            <a class="" href="">
                Click Here
            </a>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:a />'
        );
    }

    /** @test */
    public function can_be_hidden(): void
    {
        $this->assertComponentRenders(
            '',
            '<H:a :if="true == false" />'
        );
    }

    /** @test */
    public function can_accept_href_attribute(): void
    {
        $expected = <<<'HTML'
            <a class="" href="external-link">
                external-link
            </a>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:a href="external-link" />'
        );
    }

    /** @test */
    public function can_accept_route_attribute(): void
    {
        Route::get('internal-link', static function () {})->name('internal.link');

        $expected = <<<'HTML'
            <a class="" href="http://localhost/internal-link">
                http://localhost/internal-link
            </a>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:a route="internal.link" />'
        );
    }

    /** @test */
    public function can_accept_label_attribute(): void
    {
        $expected = <<<'HTML'
            <a class="" href="external-link">
                Follow Link
            </a>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:a href="external-link" label="Follow Link" />'
        );
    }

    /** @test */
    public function can_accept_custom_attribute(): void
    {
        $expected = <<<'HTML'
            <a class="" href="external-link" id="external-link">
                Follow Link
            </a>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:a href="external-link" label="Follow Link" id="external-link" />'
        );
    }

    /** @test */
    public function slot_has_more_precedence_than_label(): void
    {
        $expected = <<<'HTML'
            <a class="" href="external-link" id="external-link">
                External Link
            </a>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:a href="external-link" label="Follow Link" id="external-link">External Link</H:a>'
        );
    }
}
