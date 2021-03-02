<?php

namespace Tests\Components\Forms;

use Tests\Components\ComponentTestCase;

class ErrorTest extends ComponentTestCase
{
    /** @test */
    public function can_be_rendered()
    {
        $this->withViewErrors([
            'content' => 'The content field is required.'
        ]);

        $this->assertComponentRenders(
            '<small class="">The content field is required.</small>',
            '<H:error name="content" />',
        );
    }

    /** @test */
    public function can_be_hidden()
    {
        $this->withViewErrors([
            'content' => 'The content field is required.'
        ]);

        $this->assertComponentRenders(
            '',
            '<H:error :if="false" name="content" />',
        );
    }

    /** @test */
    public function slot_has_more_precedence_than_error_bag()
    {
        $this->withViewErrors([
            'content' => 'The content field is required.'
        ]);

        $this->assertComponentRenders(
            '<small class="">Custom Error</small>',
            '<H:error name="content">Custom Error</H:error>',
        );
    }

    /** @test */
    public function custom_attribute_can_be_set()
    {
        $this->withViewErrors([
            'content' => 'The content field is required.'
        ]);

        $this->assertComponentRenders(
            '<small class="" id="content-error">Custom Error</small>',
            '<H:error id="content-error" name="content">Custom Error</H:error>',
        );
    }

    /** @test */
    public function should_work_with_array_input()
    {
        $this->withViewErrors([
            'categories' => 'Categories must be an array.',
            'categories.*' => 'Each category should be integer.'
        ]);

        $this->assertComponentRenders(
            '<small class="">Categories must be an array.</small>',
            '<H:error name="categories[]" />',
        );
    }

    /** @test */
    public function error_key_can_be_set_with_array_input()
    {
        $this->withViewErrors([
            'categories' => 'Categories must be an array.',
            'categories.*' => 'Each category should be integer.'
        ]);

        $this->assertComponentRenders(
            '<small class="">Each category should be integer.</small>',
            '<H:error name="categories[]" key="categories.*" />',
        );
    }

    /** @test */
    public function class_can_be_added()
    {
        $this->withViewErrors([
            'content' => 'The content field is required.'
        ]);

        $this->assertComponentRenders(
            '<small class="hotash planet">Custom Error</small>',
            '<H:error class="hotash  planet   " name="content">Custom Error</H:error>',
        );
    }

    /** @test */
    public function class_can_be_passed_as_array()
    {
        $this->withViewErrors([
            'content' => 'The content field is required.'
        ]);

        $this->assertComponentRenders(
            '<small class="hotash planet">Custom Error</small>',
            '<H:error  :class="[\'hotash\', \' \', \' planet \', null]" name="content">Custom Error</H:error>',
        );
    }
}
