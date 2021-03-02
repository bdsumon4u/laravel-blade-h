<?php

namespace Tests\Components\Forms\Inputs;

use Tests\Components\ComponentTestCase;

class InputTest extends ComponentTestCase
{
    /** @test */
    public function can_be_rendered()
    {
        $this->assertComponentRenders(
            '<input class="" type="text" name="first_name" id="first-name">',
            '<H:input name="first_name" />',
        );
    }

    /** @test */
    public function can_be_hidden()
    {
        $this->assertComponentRenders(
            '',
            '<H:email :if="false" name="user[][mail]" />',
        );
    }

    /** @test */
    public function type_attribute_can_be_set_only_on_input()
    {
        $this->assertComponentRenders(
            '<input class="" type="email" name="user[][data][mail][]" id="user--data-mail">',
            '<H:input type="email" name="user[][data][mail][]" />',
        );

        $this->assertComponentRenders(
            '<input class="" type="password" name="user[][data][mail][]" id="user--data-mail">',
            '<H:password type="email" name="user[][data][mail][]" />',
        );
    }

    /** @test */
    public function id_attribute_can_be_set()
    {
        $this->assertComponentRenders(
            '<input class="" type="password" name="user[][data][password][]" id="user-password" value="passcode">',
            '<H:password name="user[][data][password][]" id="user-password" value="passcode" />',
        );
    }

    /** @test */
    public function custom_attribute_can_be_set()
    {
        $this->assertComponentRenders(
            '<input class="" type="password" name="user[][data][password][]" id="user-password" data-strength="high">',
            '<H:password name="user[][data][password][]" id="user-password" data-strength="high" />',
        );
    }

    /** @test */
    public function value_attribute_can_be_set()
    {
        $this->assertComponentRenders(
            '<input class="" type="password" name="user[][data][password][]" id="user-password" value="passcode">',
            '<H:password name="user[][data][password][]" id="user-password" value="passcode" />',
        );
    }

    /** @test */
    public function flash_old_should_work()
    {
        $this->flashOld(['user.data.password' => 'default']);
        $this->assertComponentRenders(
            '<input class="" type="password" name="user[data][password]" id="user-data-password" value="default">',
            '<H:password name="user[data][password]" value="passcode" />',
        );

        $this->flashOld(['user.0.data.password' => 'default']);
        $this->assertComponentRenders(
            '<input class="" type="password" name="user[0][data][password]" id="user-0-data-password" value="default">',
            '<H:password name="user[0][data][password]" value="passcode" />',
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
            '<input class="" type="password" name="user[][data][password]" id="user-password" value="passcode">',
            '<H:password name="user[][data][password]" id="user-password" value="passcode" />',
        );

        $this->assertComponentRenders(
            '<input class="" type="password" name="user[data][password][]" id="user-password" value="passcode">',
            '<H:password name="user[data][password][]" id="user-password" value="passcode" />',
        );
    }

    /** @test */
    public function old_key_can_be_set_for_array_input()
    {
        $this->flashOld([
            'user.0.data.password' => 'default',
            'user.data.password.1' => 'changed',
        ]);

        $this->assertComponentRenders(
            '<input class="" type="password" name="user[][data][password]" id="user-password" value="default">',
            '<H:password name="user[][data][password]" old="user.0.data.password" id="user-password" value="passcode" />',
        );

        $this->assertComponentRenders(
            '<input class="" type="password" name="user[data][password][]" id="user-password" value="changed">',
            '<H:password name="user[data][password][]" old="user.data.password.1" id="user-password" value="passcode" />',
        );
    }

    /** @test */
    public function class_can_be_added()
    {
        $this->assertComponentRenders(
            '<input class="twinkle twinkle little star" type="password" name="user[][data][password][]" id="user-password" value="passcode">',
            '<H:password name="user[][data][password][]" id="user-password" class="twinkle twinkle little star" value="passcode" />',
        );
    }

    /** @test */
    public function class_can_be_passed_as_array()
    {
        $this->assertComponentRenders(
            '<input class="hotash planet" type="password" name="user[][data][password][]" id="user-password" value="passcode">',
            '<H:password name="user[][data][password][]" id="user-password" :class="[\'hotash\', \'planet\']" value="passcode" />',
        );
    }
}
