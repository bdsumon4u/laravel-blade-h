<?php

namespace Tests\Components\Forms\Inputs;

use Tests\Components\ComponentTestCase;

class OptionTest extends ComponentTestCase
{
    /** @test */
    public function can_be_rendered()
    {
        $this->assertComponentRenders(
            '<option value=""></option>',
            '<H:option />'
        );

        $this->assertComponentRenders(
            '<option value="hotash-planet"></option>',
            '<H:option value="hotash-planet" />'
        );

        $this->assertComponentRenders(
            '<option value="hotash-planet">Hotash Planet</option>',
            '<H:option value="hotash-planet" text="Hotash Planet" />'
        );
    }

    /** @test */
    public function can_be_hidden()
    {
        $this->assertComponentRenders('', '<H:option :if="false" text="Hotash Planet" />');
    }

    /** @test */
    public function empty_value_should_not_be_selected_or_disabled_automatically()
    {
        $this->assertComponentRenders(
            '<option value="">Hotash Planet</option>',
            '<H:option value="" text="Hotash Planet" />'
        );
    }

    /** @test */
    public function slot_has_more_precidence_than_text()
    {
        $this->assertComponentRenders(
            '<option value="hotash-planet">Sumon Ahmed</option>',
            '<H:option value="hotash-planet" text="Hotash Planet">Sumon Ahmed</H:option>'
        );
    }

    /** @test */
    public function custom_attribute_can_be_set()
    {
        $this->assertComponentRenders(
            '<option value="" planet="Hotash">Hotash Planet</option>',
            '<H:option planet="Hotash" text="Hotash Planet" />',
        );
    }

    /** @test */
    public function selected_attribute_should_work_perfectly()
    {
        $expected = <<<'HTML'
            <option value="sumon-ahmed" selected="selected">Sumon Ahmed</option>
            <option value="hello-world">Hello World</option>
            <option value="hotash-planet" selected="selected">Hotash Planet</option>
            HTML;

        $template = <<<'HTML'
            <H:option value="sumon-ahmed" selected>Sumon Ahmed</H:option>
            <H:option value="hello-world" selected="">Hello World</H:option>
            <H:option value="hotash-planet" selected="selected">Hotash Planet</H:option>
            HTML;

        $this->assertComponentRenders($expected, $template);
    }

    /** @test */
    public function selected_equals_boolean_can_be_used()
    {
        $expected = <<<'HTML'
            <option value="sumon-ahmed">Hotash Planet</option>
            <option value="hotash-planet" selected="selected">Sumon Ahmed</option>
            <option value="hotash-planet">Sumon Ahmed</option>
            HTML;

        $template = <<<'HTML'
            <H:option value="sumon-ahmed" :selected="false">Hotash Planet</H:option>
            <H:option value="hotash-planet" :selected="true">Sumon Ahmed</H:option>
            <H:option value="hotash-planet" :selected="true == false">Sumon Ahmed</H:option>
            HTML;

        $this->assertComponentRenders($expected, $template);
    }

    /** @test */
    public function selected_equals_string_should_be_selected()
    {
        $expected = <<<'HTML'
            <option value="sumon-ahmed" selected="selected">Hotash Planet</option>
            <option value="hotash-planet" selected="selected">Sumon Ahmed</option>
            <option value="hotash-planet" selected="selected">Sumon Ahmed</option>
            HTML;

        $template = <<<'HTML'
            <H:option value="sumon-ahmed" selected="false">Hotash Planet</H:option>
            <H:option value="hotash-planet" selected="sumon-ahmed">Sumon Ahmed</H:option>
            <H:option value="hotash-planet" selected="hotash-planet">Sumon Ahmed</H:option>
            HTML;

        $this->assertComponentRenders($expected, $template);
    }

    /** @test */
    public function disabled_attribute_should_work_perfectly()
    {
        $expected = <<<'HTML'
            <option value="sumon-ahmed" disabled="disabled">Sumon Ahmed</option>
            <option value="hello-world">Hello World</option>
            <option value="hotash-planet" disabled="disabled">Hotash Planet</option>
            HTML;

        $template = <<<'HTML'
            <H:option value="sumon-ahmed" disabled>Sumon Ahmed</H:option>
            <H:option value="hello-world" disabled="">Hello World</H:option>
            <H:option value="hotash-planet" disabled="disabled">Hotash Planet</H:option>
            HTML;

        $this->assertComponentRenders($expected, $template);
    }

    /** @test */
    public function disabled_equals_boolean_can_be_used()
    {
        $expected = <<<'HTML'
            <option value="sumon-ahmed">Hotash Planet</option>
            <option value="hotash-planet" disabled="disabled">Sumon Ahmed</option>
            <option value="hotash-planet">Sumon Ahmed</option>
            HTML;

        $template = <<<'HTML'
            <H:option value="sumon-ahmed" :disabled="false">Hotash Planet</H:option>
            <H:option value="hotash-planet" :disabled="true">Sumon Ahmed</H:option>
            <H:option value="hotash-planet" :disabled="true == false">Sumon Ahmed</H:option>
            HTML;

        $this->assertComponentRenders($expected, $template);
    }

    /** @test */
    public function disabled_equals_string_should_be_disabled()
    {
        $expected = <<<'HTML'
            <option value="sumon-ahmed" disabled="disabled">Hotash Planet</option>
            <option value="hotash-planet" disabled="disabled">Sumon Ahmed</option>
            <option value="hotash-planet" disabled="disabled">Sumon Ahmed</option>
            HTML;

        $template = <<<'HTML'
            <H:option value="sumon-ahmed" disabled="false">Hotash Planet</H:option>
            <H:option value="hotash-planet" disabled="sumon-ahmed">Sumon Ahmed</H:option>
            <H:option value="hotash-planet" disabled="hotash-planet">Sumon Ahmed</H:option>
            HTML;

        $this->assertComponentRenders($expected, $template);
    }
}
