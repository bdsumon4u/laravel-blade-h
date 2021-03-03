<?php

namespace Tests\Components\Forms\Inputs;

use Tests\Components\ComponentTestCase;
use Tests\Models\User;

class CheckableTest extends ComponentTestCase
{
    /** @test */
    public function can_be_rendered()
    {
        $this->assertComponentRenders(
            '<input class="" type="radio" name="gender" id="gender-male" value="male">',
            '<H:radio name="gender" value="male" />',
        );

        $this->assertComponentRenders(
            '<input class="" type="checkbox" name="check[]" id="check-football" value="football">',
            '<H:checkbox name="check[]" value="football" />',
        );
    }

    /** @test */
    public function can_be_hidden()
    {
        $this->assertComponentRenders(
            '',
            '<H:radio :if="false" name="gender" value="male" />',
        );
    }

    /** @test */
    public function checked_attribute_can_be_used()
    {
        $this->assertComponentRenders(
            '<input class="" type="radio" name="gender" id="gender-male" value="male" checked="checked">',
            '<H:radio name="gender" value="male" checked />',
        );
    }

    /** @test */
    public function checked_attribute_can_be_checked()
    {
        $this->assertComponentRenders(
            '<input class="" type="radio" name="gender" id="gender-male" value="male" checked="checked">',
            '<H:radio name="gender" value="male" checked="checked" />',
        );
    }

    /** @test */
    public function checked_attribute_can_be_string()
    {
        $this->assertComponentRenders(
            '<input class="" type="radio" name="gender" id="gender-male" value="male" checked="checked">',
            '<H:radio name="gender" value="male" :checked="\'male\'" />',
        );

        $this->assertComponentRenders(
            '<input class="" type="radio" name="gender" id="gender-male" value="male">',
            '<H:radio name="gender" value="male" :checked="\'female\'" />',
        );
    }

    /** @test */
    public function checked_attribute_can_be_array()
    {
        $template = <<<'HTML'
            <H:form method="PuT" action="http://example.com">
                @php $checked = ['football', 'cricket', 'basketball'] @endphp
                <H:checkbox name="check[]" value="football" :checked="$checked" />
                <H:checkbox name="check[]" value="cricket" :checked="$checked" />
                <H:checkbox name="check[]" value="badminton" :checked="$checked" />
                <H:checkbox name="check[]" value="basketball" :checked="$checked" />
            </H:form>
            HTML;

        $expected = <<<'HTML'
            <form method="POST" class="" enctype="application/x-www-form-urlencoded" action="http://example.com">
                <input type="hidden" name="_token" value="">
                <input type="hidden" name="_method" value="PUT">
                <input class="" type="checkbox" name="check[]" id="check-football" value="football" checked="checked">
                <input class="" type="checkbox" name="check[]" id="check-cricket" value="cricket" checked="checked">
                <input class="" type="checkbox" name="check[]" id="check-badminton" value="badminton">
                <input class="" type="checkbox" name="check[]" id="check-basketball" value="basketball" checked="checked">
            </form>
            HTML;

        $this->assertComponentRenders($expected, $template);
    }

    /** @test */
    public function checked_equals_checked_will_check_all()
    {
        $template = <<<'HTML'
            <H:form method="PuT" action="http://example.com">
                @php $checked = 'checked' @endphp
                <H:radio name="check" value="checked" :checked="$checked" />
                <H:radio name="check" value="unchecked" :checked="$checked" />
            </H:form>
            HTML;

        $expected = <<<'HTML'
            <form method="POST" class="" enctype="application/x-www-form-urlencoded" action="http://example.com">
                <input type="hidden" name="_token" value="">
                <input type="hidden" name="_method" value="PUT">
                <input class="" type="radio" name="check" id="check-checked" value="checked" checked="checked">
                <input class="" type="radio" name="check" id="check-unchecked" value="unchecked" checked="checked">
            </form>
            HTML;

        $this->assertComponentRenders($expected, $template);
    }

    /** @test */
    public function flash_old_should_work()
    {
        $this->flashOld(['check' => ['cricket', 'basketball']]);
        $template = <<<'HTML'
            <H:form method="PuT" action="http://example.com">
                @php $checked = ['football', 'cricket', 'basketball'] @endphp
                <H:checkbox name="check[]" value="football" :checked="$checked" />
                <H:checkbox name="check[]" value="cricket" :checked="$checked" />
                <H:checkbox name="check[]" value="badminton" :checked="$checked" />
                <H:checkbox name="check[]" value="basketball" :checked="$checked" />
            </H:form>
            HTML;

        $expected = <<<'HTML'
            <form method="POST" class="" enctype="application/x-www-form-urlencoded" action="http://example.com">
                <input type="hidden" name="_token" value="">
                <input type="hidden" name="_method" value="PUT">
                <input class="" type="checkbox" name="check[]" id="check-football" value="football">
                <input class="" type="checkbox" name="check[]" id="check-cricket" value="cricket" checked="checked">
                <input class="" type="checkbox" name="check[]" id="check-badminton" value="badminton">
                <input class="" type="checkbox" name="check[]" id="check-basketball" value="basketball" checked="checked">
            </form>
            HTML;

        $this->assertComponentRenders($expected, $template);
    }

    /** @test */
    public function radio_can_access_model_attribute()
    {
        $template = <<<HTML
            <H:form :model="Tests\Models\User::factory()->make(['gender' => 'female'])" method="PuT" action="http://example.com">
                <H:radio name="gender" value="male" />
                <H:radio name="gender" value="female" />
                <H:radio name="gender" value="other" />
            </H:form>
            HTML;

        $expected = <<<'HTML'
            <form method="POST" class="" enctype="application/x-www-form-urlencoded" action="http://example.com">
                <input type="hidden" name="_token" value="">
                <input type="hidden" name="_method" value="PUT">
                <input class="" type="radio" name="gender" id="gender-male" value="male">
                <input class="" type="radio" name="gender" id="gender-female" value="female" checked="checked">
                <input class="" type="radio" name="gender" id="gender-other" value="other">
            </form>
            HTML;

        $this->assertComponentRenders($expected, $template);
    }

    /** @test */
    public function checkbox_can_access_model_attribute()
    {
        $model = User::factory()->make(['hobbies' => ['reading', 'coding']]);

        $template = <<<'HTML'
            <H:form :model="$model" method="PuT" action="http://example.com">
                <H:checkbox name="hobbies[]" value="reading" />
                <H:checkbox name="hobbies[]" value="coding" />
                <H:checkbox name="hobbies[]" value="nothing" />
                <H:checkbox name="hobbies[]" value="everything" />
            </H:form>
            HTML;

        $expected = <<<'HTML'
            <form method="POST" class="" enctype="application/x-www-form-urlencoded" action="http://example.com">
                <input type="hidden" name="_token" value="">
                <input type="hidden" name="_method" value="PUT">
                <input class="" type="checkbox" name="hobbies[]" id="hobbies-reading" value="reading" checked="checked">
                <input class="" type="checkbox" name="hobbies[]" id="hobbies-coding" value="coding" checked="checked">
                <input class="" type="checkbox" name="hobbies[]" id="hobbies-nothing" value="nothing">
                <input class="" type="checkbox" name="hobbies[]" id="hobbies-everything" value="everything">
            </form>
            HTML;

        $this->assertComponentRenders($expected, $template, compact('model'));
    }

    /** @test */
    public function flash_old_has_more_precedence_than_model()
    {
        $model = User::factory()->make(['hobbies' => ['reading', 'coding']]);
        $this->flashOld(['hobbies' => ['nothing']]);

        $template = <<<'HTML'
            <H:form :model="$model" method="PuT" action="http://example.com">
                <H:checkbox name="hobbies[]" value="reading" />
                <H:checkbox name="hobbies[]" value="coding" />
                <H:checkbox name="hobbies[]" value="nothing" />
                <H:checkbox name="hobbies[]" value="everything" />
            </H:form>
            HTML;

        $expected = <<<'HTML'
            <form method="POST" class="" enctype="application/x-www-form-urlencoded" action="http://example.com">
                <input type="hidden" name="_token" value="">
                <input type="hidden" name="_method" value="PUT">
                <input class="" type="checkbox" name="hobbies[]" id="hobbies-reading" value="reading">
                <input class="" type="checkbox" name="hobbies[]" id="hobbies-coding" value="coding">
                <input class="" type="checkbox" name="hobbies[]" id="hobbies-nothing" value="nothing" checked="checked">
                <input class="" type="checkbox" name="hobbies[]" id="hobbies-everything" value="everything">
            </form>
            HTML;

        $this->assertComponentRenders($expected, $template, compact('model'));
    }

    /** @test */
    public function class_can_be_added()
    {
        $this->assertComponentRenders(
            '<input class="twinkle twinkle little star" type="radio" name="gender" id="gender-male" value="male">',
            '<H:radio name="gender" class="twinkle twinkle little star" value="male" />',
        );

        $this->assertComponentRenders(
            '<input class="twinkle twinkle little star" type="checkbox" name="check[]" id="check-football" value="football">',
            '<H:checkbox name="check[]" class="twinkle twinkle little star" value="football" />',
        );
    }

    /** @test */
    public function class_can_be_passed_as_array()
    {
        $this->assertComponentRenders(
            '<input class="hotash planet" type="radio" name="gender" id="gender-male" value="male">',
            '<H:radio name="gender" :class="[\'hotash\', \'planet\']" value="male" />',
        );

        $this->assertComponentRenders(
            '<input class="hotash planet" type="checkbox" name="check[]" id="check-football" value="football">',
            '<H:checkbox name="check[]" :class="[\'hotash\', \'planet\']" value="football" />',
        );
    }
}
