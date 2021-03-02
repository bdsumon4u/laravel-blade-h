<?php

namespace Tests\Components\Forms;

use Tests\Components\ComponentTestCase;

class LabelTest extends ComponentTestCase
{
    /** @test */
    public function can_be_rendered()
    {
        $this->assertComponentRenders(
            '<label class="" for=""></label>',
            '<H:label />',
        );
    }

    /** @test */
    public function name_can_be_set()
    {
        $this->assertComponentRenders(
            '<label class="" for="user--data-password">User Data Password</label>',
            '<H:label name="user[][data][password][]" />',
        );
    }

    /** @test */
    public function required_can_be_set()
    {
        $this->assertComponentRenders(
            '<label class="" for="user--data-password" title="Required">User Data Password<span>*</span></label>',
            '<H:label name="user[][data][password][]" required />',
        );
    }

    /** @test */
    public function for_attribute_can_be_set()
    {
        $this->assertComponentRenders(
            '<label class="" for="user-password">User Password</label>',
            '<H:label for="user-password" />',
        );
    }

    /** @test */
    public function for_has_more_precedence_than_name()
    {
        $this->assertComponentRenders(
            '<label class="" for="user-password">User Password</label>',
            '<H:label for="user-password" name="user[][data][password]" />',
        );
    }

    /** @test */
    public function text_can_be_set()
    {
        $this->assertComponentRenders(
            '<label class="" for="user--data-password" title="Required">Password<span>*</span></label>',
            '<H:label name="user[][data][password][]" text="Password" required />',
        );

        $this->assertComponentRenders(
            '<label class="" for="user-password">Password</label>',
            '<H:label for="user-password" text="Password" />',
        );
    }

    /** @test */
    public function slot_has_more_precedence_than_text()
    {
        $this->assertComponentRenders(
            '<label class="" for="user--data-password" title="Required">Confirm Password<span>*</span></label>',
            '<H:label name="user[][data][password][]" text="Password" required>Confirm Password</H:label>',
        );
    }

    /** @test */
    public function custom_attribute_can_be_set()
    {
        $this->assertComponentRenders(
            '<label class="" for="user--data-password" data-ink="pink">User Data Password</label>',
            '<H:label name="user[][data][password][]" data-ink="pink" />',
        );
    }

    /** @test */
    public function for_attribute_has_more_precedence_than_name()
    {
        $this->assertComponentRenders(
            '<label class="" for="user-pass" title="Required">Password<span>*</span></label>',
            '<H:label for="user-pass" name="user[][data][password][]" text="Password" required />',
        );
    }

    /** @test */
    public function class_can_be_added()
    {
        $this->assertComponentRenders(
            '<label class="hotash planet" for="user-password">User Password</label>',
            '<H:label class="hotash  planet   " for="user-password" />',
        );
    }

    /** @test */
    public function class_can_be_passed_as_array()
    {
        $this->assertComponentRenders(
            '<label class="hotash planet" for="user-password">User Password</label>',
            '<H:label :class="[\'hotash\', \' \', \' planet \', null]" for="user-password" />',
        );
    }
}
