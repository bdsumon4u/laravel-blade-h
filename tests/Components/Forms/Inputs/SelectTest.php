<?php

namespace Tests\Components\Forms\Inputs;

use Tests\Components\ComponentTestCase;
use Tests\Models\User;

class SelectTest extends ComponentTestCase
{
    /** @test */
    public function can_be_rendered()
    {
        $this->assertComponentRenders(
            '<select class="" name="user_id" id="user-id"></select>',
            '<H:select name="user_id" />'
        );
    }

    /** @test */
    public function can_be_hidden()
    {
        $this->assertComponentRenders('', '<H:select :if="false" name="user_id" />');
    }

    /** @test */
    public function can_render_1d_array()
    {
        $expected = <<<'HTML'
            <select class="" name="id" id="id">
                <option value="1">1</option>
                <option value="4">4</option>
                <option value="7">7</option>
            </select>
            HTML;

        $this->assertComponentRenders($expected, '<H:select name="id" :value="[1, 4, 7]" />');

        $expected = <<<'HTML'
            <select class="" name="status" id="status">
                <option value="Pending">Pending</option>
                <option value="Complete">Complete</option>
                <option value="Returned">Returned</option>
            </select>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:select name="status" :value="$status" />',
            ['status' => ['Pending', 'Complete', 'Returned']]
        );
    }

    /** @test */
    public function can_render_1d_array_from_flash_old()
    {
        $this->flashOld(['id' => [1, 7]]);
        $expected = <<<'HTML'
            <select class="" name="id" id="id">
                <option value="1" selected="selected">1</option>
                <option value="4">4</option>
                <option value="7" selected="selected">7</option>
            </select>
            HTML;

        $this->assertComponentRenders($expected, '<H:select name="id" :value="[1, 4, 7]" />');

        $expected = <<<'HTML'
            <select class="" name="status" id="status">
                <option value="Pending">Pending</option>
                <option value="Complete">Complete</option>
                <option value="Returned">Returned</option>
            </select>
            HTML;

        $this->assertComponentRenders($expected,
            '<H:select name="status" :value="$status" />',
            ['status' => ['Pending', 'Complete', 'Returned']]
        );
    }

    /** @test */
    public function can_render_associative_array()
    {
        $expected = <<<'HTML'
            <select class="" name="status" id="status">
                <option value="pending">Pending</option>
                <option value="complete">Complete</option>
                <option value="returned">Returned</option>
            </select>
            HTML;

        $status = [
            'pending' => 'Pending',
            'complete' => 'Complete',
            'returned' => 'Returned',
        ];
        $this->assertComponentRenders($expected,
            '<H:select name="status" :value="$status" />',
            compact('status')
        );
    }

    /** @test */
    public function can_render_associative_array_from_flash_old()
    {
        $this->flashOld(['status' => 'complete']);
        $expected = <<<'HTML'
            <select class="" name="status" id="status">
                <option value="pending">Pending</option>
                <option value="complete" selected="selected">Complete</option>
                <option value="returned">Returned</option>
            </select>
            HTML;

        $status = [
            'pending' => 'Pending',
            'complete' => 'Complete',
            'returned' => 'Returned',
        ];
        $this->assertComponentRenders($expected,
            '<H:select name="status" :value="$status" />',
            compact('status')
        );
    }

    /** @test */
    public function slot_has_more_precidence_than_value()
    {
        $expected = <<<'HTML'
            <select class="" name="student_info" id="student-info">
                <option value="php">PHP</option>
                <option value="laravel">Laravel</option>
            </select>
            HTML;

        $data = [4 => 'Hotash Planet', 5 => 'Sumon Ahmed'];
        $template = <<<'HTML'
            <H:select name="student_info" :value="$data">
                <option value="php">PHP</option>
                <option value="laravel">Laravel</option>
            </H:select>
            HTML;

        $this->assertComponentRenders($expected, $template, compact('data'));
    }

    /** @test */
    public function can_access_form_model()
    {
        $model = User::factory()->make();
        $expected = <<<'HTML'
            <form method="GET" class="" enctype="application/x-www-form-urlencoded">
                <select class="" name="hobbies" id="hobbies">
                    @foreach($model->hobbies ?: [] as $hobby)
                    <option value="{{ $hobby }}">{{ $hobby }}</option>
                    @endforeach
                </select>
            </form>
            HTML;

        $template = <<<'HTML'
            <H:form :model="$model">
                <H:select name="hobbies" />
            </H:form>
            HTML;

        $this->assertComponentRenders($this->indentedBlade($expected, compact('model')), $template, compact('model'));
    }

    /** @test */
    public function class_can_be_added()
    {
        $this->assertComponentRenders(
            '<select class="twinkle twinkle little star" name="user_id" id="user-id"></select>',
            '<H:select name="user_id" class="twinkle twinkle little star" />',
        );
    }

    /** @test */
    public function class_can_be_passed_as_array()
    {
        $this->assertComponentRenders(
            '<select class="hotash planet" name="user_id" id="user-id"></select>',
            '<H:select name="user_id" :class="[\'hotash\', \'planet\']" />',
        );
    }

    /** @test */
    public function selected_equals_string_attribute_can_be_used()
    {
        $expected = <<<'HTML'
            <select class="" name="demo" id="demo">
                <option value="sumon-ahmed">Sumon Ahmed</option>
                <option value="hotash-planet">Hotash Planet</option>
                <option value="php">PHP</option>
                <option value="laravel" selected="selected">Laravel</option>
                <option value="javascript">JavaScript</option>
            </select>
            HTML;

        $value = [
            'sumon-ahmed' => 'Sumon Ahmed',
            'hotash-planet' => 'Hotash Planet',
            'php' => 'PHP',
            'laravel' => 'Laravel',
            'javascript' => 'JavaScript',
        ];

        $this->assertComponentRenders($expected, '<H:select name="demo" :value="$value" selected="laravel" />', compact('value'));
    }

    /** @test */
    public function selected_equals_array_attribute_can_be_used()
    {
        $expected = <<<'HTML'
            <select class="" name="demo" id="demo">
                <option value="sumon-ahmed">Sumon Ahmed</option>
                <option value="hotash-planet" selected="selected">Hotash Planet</option>
                <option value="php">PHP</option>
                <option value="laravel" selected="selected">Laravel</option>
                <option value="javascript">JavaScript</option>
            </select>
            HTML;

        $value = [
            'sumon-ahmed' => 'Sumon Ahmed',
            'hotash-planet' => 'Hotash Planet',
            'php' => 'PHP',
            'laravel' => 'Laravel',
            'javascript' => 'JavaScript',
        ];
        $selected = ['hotash-planet', 'laravel'];

        $this->assertComponentRenders($expected, '<H:select name="demo" :value="$value" :selected="$selected" />', compact('value', 'selected'));
    }

    /** @test */
    public function disabled_equals_string_attribute_can_be_used()
    {
        $expected = <<<'HTML'
            <select class="" name="demo" id="demo">
                <option value="sumon-ahmed">Sumon Ahmed</option>
                <option value="hotash-planet">Hotash Planet</option>
                <option value="php">PHP</option>
                <option value="laravel" disabled="disabled">Laravel</option>
                <option value="javascript">JavaScript</option>
            </select>
            HTML;

        $value = [
            'sumon-ahmed' => 'Sumon Ahmed',
            'hotash-planet' => 'Hotash Planet',
            'php' => 'PHP',
            'laravel' => 'Laravel',
            'javascript' => 'JavaScript',
        ];

        $this->assertComponentRenders($expected, '<H:select name="demo" :value="$value" disabled="laravel" />', compact('value'));
    }

    /** @test */
    public function disabled_equals_array_attribute_can_be_used()
    {
        $expected = <<<'HTML'
            <select class="" name="demo" id="demo">
                <option value="sumon-ahmed">Sumon Ahmed</option>
                <option value="hotash-planet" disabled="disabled">Hotash Planet</option>
                <option value="php">PHP</option>
                <option value="laravel" disabled="disabled">Laravel</option>
                <option value="javascript">JavaScript</option>
            </select>
            HTML;

        $value = [
            'sumon-ahmed' => 'Sumon Ahmed',
            'hotash-planet' => 'Hotash Planet',
            'php' => 'PHP',
            'laravel' => 'Laravel',
            'javascript' => 'JavaScript',
        ];
        $disabled = ['hotash-planet', 'laravel'];

        $this->assertComponentRenders($expected, '<H:select name="demo" :value="$value" :disabled="$disabled" />', compact('value', 'disabled'));
    }
}
