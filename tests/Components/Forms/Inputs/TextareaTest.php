<?php

namespace Tests\Components\Forms\Inputs;

use Tests\Components\ComponentTestCase;

class TextareaTest extends ComponentTestCase
{
    /** @test */
    public function can_be_rendered()
    {
        $this->assertComponentRenders(
            '<textarea class="" name="content" id="content"></textarea>',
            '<H:textarea name="content" />',
        );
    }

    /** @test */
    public function can_be_hidden()
    {
        $this->assertComponentRenders(
            '',
            '<H:textarea :if="false" name="content" />',
        );
    }

    /** @test */
    public function custom_attribute_can_be_set()
    {
        $this->assertComponentRenders(
            '<textarea class="" name="content" id="content" rows="4" type="number"></textarea>',
            '<H:textarea rows="4" name="content" type="number" />',
        );
    }

    /** @test */
    public function value_attribute_can_be_set()
    {
        $this->assertComponentRenders(
            '<textarea class="" name="content" id="content">Hotash Planet</textarea>',
            '<H:textarea name="content" value="Hotash Planet" />',
        );

        $this->assertComponentRenders(
            '<textarea class="" name="content" id="content">Sumon Ahmed</textarea>',
            '<H:textarea name="content" value="">Sumon Ahmed</H:textarea>',
        );
    }

    /** @test */
    public function flash_old_should_work()
    {
        $this->flashOld(['content' => 'Hotash Planet']);
        $this->assertComponentRenders(
            '<textarea class="" name="content" id="content">Hotash Planet</textarea>',
            '<H:textarea name="content" value="Sumon Ahmed" />',
        );

        $this->assertComponentRenders(
            '<textarea class="" name="content" id="content">Hotash Planet</textarea>',
            '<H:textarea name="content" value="">Sumon Ahmed</H:textarea>',
        );
    }

    /** @test */
    public function flash_old_should_not_work_with_array_input()
    {
        $this->flashOld([
            'user.0.data.password' => 'default',
            'user.data.password.0' => 'changed',
        ]);

        $this->assertComponentRenders(
            '<textarea class="" name="user[][data][bio]" id="user-bio">My Bio</textarea>',
            '<H:textarea name="user[][data][bio]" id="user-bio" value="My Bio" />',
        );

        $this->assertComponentRenders(
            '<textarea class="" name="user[data][bio][]" id="user-bio">My Bio</textarea>',
            '<H:textarea name="user[data][bio][]" id="user-bio" value="Bio">My Bio</H:textarea>',
        );
    }

    /** @test */
    public function old_key_can_be_set_for_array_input()
    {
        $this->flashOld([
            'user.0.data.bio' => 'My Bio',
            'user.data.bio.1' => 'My Bio',
        ]);

        $this->assertComponentRenders(
            '<textarea class="" name="user[][data][bio]" id="user-bio">My Bio</textarea>',
            '<H:textarea name="user[][data][bio]" key="user.0.data.bio" id="user-bio" value="Bio" />',
        );

        $this->assertComponentRenders(
            '<textarea class="" name="user[data][bio][]" id="user-bio">My Bio</textarea>',
            '<H:textarea name="user[data][bio][]" key="user.data.bio.1" id="user-bio" value="Biography">Bio</H:textarea>',
        );
    }

    /** @test */
    public function class_can_be_added()
    {
        $this->assertComponentRenders(
            '<textarea class="twinkle twinkle little star" name="content" id="content"></textarea>',
            '<H:textarea name="content" class="twinkle twinkle little star" />',
        );
    }

    /** @test */
    public function class_can_be_passed_as_array()
    {
        $this->assertComponentRenders(
            '<textarea class="hotash planet" name="content" id="content">Hotash Planet</textarea>',
            '<H:textarea name="content" :class="[\'hotash\', \'planet\']" value="Hotash Planet" />',
        );
    }
}
