<?php

namespace Tests\Components\Forms;

use Tests\Components\ComponentTestCase;

class FormTest extends ComponentTestCase
{
    /** @test */
    public function can_be_rendered()
    {
        $expected = <<<'HTML'
            <form method="GET" class="" enctype="application/x-www-form-urlencoded">
                Form fields...
            </form>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:form>Form fields...</H:form>'
        );
    }

    /** @test */
    public function can_be_hidden()
    {
        $template = <<<'HTML'
            <H:form :if="false">
                Form fields...
            </H:form>
            HTML;

        $this->assertComponentRenders('', $template);
    }

    /** @test */
    public function action_can_be_set()
    {
        $expected = <<<'HTML'
            <form method="GET" class="" enctype="application/x-www-form-urlencoded" action="http://example.com">
                Form fields...
            </form>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:form action="http://example.com">Form fields...</H:form>'
        );
    }

    /** @test */
    public function method_can_be_set()
    {
        $expected = <<<'HTML'
            <form method="POST" class="" enctype="application/x-www-form-urlencoded" action="http://localhost/example">
                <input type="hidden" name="_token" value="">
                <input type="hidden" name="_method" value="PATCH">
                Form fields...

            </form>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:form method="PaTcH" action="http://localhost/example">Form fields...</H:form>'
        );
    }

    /** @test */
    public function enctype_can_be_set()
    {
        $expected = <<<'HTML'
            <form method="POST" class="" enctype="text/plain" action="http://localhost/example">
                <input type="hidden" name="_token" value="">
                <input type="hidden" name="_method" value="PATCH">
                Form fields...

            </form>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:form method="PaTcH" action="http://localhost/example" enctype="text/plain">Form fields...</H:form>'
        );
    }

    /** @test */
    public function multipart_can_be_set()
    {
        $expected = <<<'HTML'
            <form method="POST" class="" enctype="multipart/form-data" action="http://localhost/example">
                <input type="hidden" name="_token" value="">
                <input type="hidden" name="_method" value="PATCH">
                Form fields...

            </form>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:form method="PaTcH" action="http://localhost/example" multipart>Form fields...</H:form>'
        );
    }

    /** @test */
    public function custom_attribute_can_be_set(): void
    {
        $expected = <<<'HTML'
            <form method="GET" class="" enctype="application/x-www-form-urlencoded" action="http://example.com" id="hotash-form">
                Form fields...
            </form>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:form action="http://example.com" id="hotash-form">Form fields...</H:form>'
        );
    }

    /** @test */
    public function class_can_be_added()
    {
        $expected = <<<'HTML'
            <form method="GET" class="twinkle twinkle little star" enctype="application/x-www-form-urlencoded" action="http://example.com" id="hotash-form">
                Form fields...
            </form>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:form action="http://example.com" id="hotash-form" class="twinkle twinkle little star">Form fields...</H:form>'
        );
    }

    /** @test */
    public function class_can_be_passed_as_array()
    {
        $expected = <<<'HTML'
            <form method="GET" class="hotash planet" enctype="application/x-www-form-urlencoded" action="http://example.com" id="hotash-form">
                Form fields...
            </form>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:form action="http://example.com" id="hotash-form" :class="[\'hotash\', \'planet\']">Form fields...</H:form>'
        );
    }
}
