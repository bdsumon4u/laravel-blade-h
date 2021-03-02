<?php

namespace Tests\Components\Forms\Inputs;

use Tests\Components\ComponentTestCase;
use Tests\Models\User;

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
            '<H:password name="user[][data][password]" key="user.0.data.password" id="user-password" value="passcode" />',
        );

        $this->assertComponentRenders(
            '<input class="" type="password" name="user[data][password][]" id="user-password" value="changed">',
            '<H:password name="user[data][password][]" key="user.data.password.1" id="user-password" value="passcode" />',
        );
    }

    /** @test */
    public function can_access_form_model()
    {
        $model = User::factory()->make(['name' => 'Hotash Planet']);

        $expected = <<<'HTML'
            <form method="GET" class="" enctype="application/x-www-form-urlencoded">
                <input class="" type="text" name="name" id="name" value="Hotash Planet">
                <input class="" type="email" name="email" id="email" value="{{ $model->email }}">
                <input class="" type="number" name="age" id="age" value="{{ $model->age }}">
                @foreach($model->hobbies ?: [] as $hobby)
                    <input class="" type="text" name="hobbies[]" id="hobbies-{{ str_replace(' ', '-', $hobby) }}" value="{{ ucwords($hobby) }}">
                @endforeach
            </form>
            HTML;

        $template = <<<'HTML'
            <H:form :model="$model">
                <H:input name="name" />
                <H:email name="email" />
                <H:number name="age" />
                @foreach(FormH::get('hobbies', []) as $hobby)
                    <H:input name="hobbies[]" :id="'hobbies-'.str_replace(' ', '-', $hobby)" :value="ucwords($hobby)" />
                @endforeach
            </H:form>
            HTML;

        $this->assertComponentRenders($this->indentedBlade($expected, compact('model')), $template, compact('model'));
    }

    /** @test */
    public function explicit_value_has_more_precedence_than_model_attribute()
    {
        $model = User::factory()->make(['name' => 'Hotash Planet']);

        $expected = <<<'HTML'
            <form method="GET" class="" enctype="application/x-www-form-urlencoded">
                <input class="" type="text" name="name" id="name" value="Hotash Planet">
                <input class="" type="email" name="email" id="email" value="{{ $model->email }}">
                <input class="" type="number" name="age" id="age" value="21">
                <input class="" type="text" name="hobbies[]" id="hobbies-coding" value="Coding">
            </form>
            HTML;

        $template = <<<'HTML'
            <H:form :model="$model">
                <H:input name="name" />
                <H:email name="email" />
                <H:number name="age" value="21" />
                @foreach(FormH::value('hobbies', ['coding']) as $hobby)
                    <H:input name="hobbies[]" :id="'hobbies-'.$hobby" :value="ucwords($hobby)" />
                @endforeach
            </H:form>
            HTML;

        $this->assertComponentRenders($this->indentedBlade($expected, compact('model')), $template, compact('model'));
    }

    /** @test */
    public function old_value_has_more_precedence_than_explicit_value()
    {
        $model = User::factory()->make(['name' => 'Hotash Planet']);
        $this->flashOld([
            'hobbies.0' => 'Reading',
            'hobbies.1' => 'Coding',
            'email' => 'bdsumon4u@gmail.com',
        ]);

        $expected = <<<'HTML'
            <form method="GET" class="" enctype="application/x-www-form-urlencoded">
                <input class="" type="text" name="name" id="name" value="Hotash Planet">
                <input class="" type="email" name="email" id="email" value="bdsumon4u@gmail.com">
                <input class="" type="number" name="age" id="age" value="21">
            </form>
            HTML;

        $template = <<<'HTML'
            <H:form :model="$model">
                <H:input name="name" />
                <H:email name="email" />
                <H:number name="age" value="21" />
            </H:form>
            HTML;

        $this->assertComponentRenders($this->indentedBlade($expected, compact('model')), $template, compact('model'));
    }

    /** @test */
    public function old_value_should_work_with_indexed_array_input()
    {
        $model = User::factory()->make(['name' => 'Hotash Planet']);
        $this->flashOld([
            'hobbies.0' => 'Reading',
            'hobbies.1' => 'Coding',
            'email' => 'bdsumon4u@gmail.com',
        ]);

        $expected = <<<'HTML'
            <form method="GET" class="" enctype="application/x-www-form-urlencoded">
                <input class="" type="text" name="name" id="name" value="Hotash Planet">
                <input class="" type="email" name="email" id="email" value="bdsumon4u@gmail.com">
                <input class="" type="number" name="age" id="age" value="{{ $model->age }}">
                <input class="" type="text" name="hobbies[0]" id="hobbies-0" value="Reading">
                <input class="" type="text" name="hobbies[1]" id="hobbies-1" value="Coding">
            </form>
            HTML;

        $template = <<<'HTML'
            <H:form :model="$model">
                <H:input name="name" />
                <H:email name="email" />
                <H:number name="age" />
                <H:input name="hobbies[0]" id="hobbies-0" value="Nothing" />
                <H:input name="hobbies[1]" id="hobbies-1" value="Everything" />
            </H:form>
            HTML;

        $this->assertComponentRenders($this->indentedBlade($expected, compact('model')), $template, compact('model'));
    }

    /** @test */
    public function old_value_should_not_work_with_array_input()
    {
        $model = User::factory()->make(['name' => 'Hotash Planet']);
        $this->flashOld([
            'hobbies.0' => 'Reading',
            'hobbies.1' => 'Coding',
            'email' => 'bdsumon4u@gmail.com',
        ]);

        $expected = <<<'HTML'
            <form method="GET" class="" enctype="application/x-www-form-urlencoded">
                <input class="" type="text" name="name" id="name" value="Hotash Planet">
                <input class="" type="email" name="email" id="email" value="bdsumon4u@gmail.com">
                <input class="" type="number" name="age" id="age" value="{{ $model->age }}">
                <input class="" type="text" name="hobbies[]" id="hobbies-0" value="Nothing">
                <input class="" type="text" name="hobbies[]" id="hobbies-1" value="Coding">
            </form>
            HTML;

        $template = <<<'HTML'
            <H:form :model="$model">
                <H:input name="name" />
                <H:email name="email" />
                <H:number name="age" />
                <H:input name="hobbies[]" id="hobbies-0" value="Nothing" />
                <H:input name="hobbies[]" id="hobbies-1" key="hobbies.1" value="Everything" />
            </H:form>
            HTML;

        $this->assertComponentRenders($this->indentedBlade($expected, compact('model')), $template, compact('model'));
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
