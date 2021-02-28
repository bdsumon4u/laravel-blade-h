<?php

namespace Tests\Components;

use Gajus\Dindent\Indenter;
use Hotash\BladeH\Providers\BladeHServiceProvider;
use Orchestra\Testbench\TestCase;
use Tests\Traits\InteractsWithViews;

abstract class ComponentTestCase extends TestCase
{
    use InteractsWithViews;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('view:clear');
    }

    protected function flashOld(array $input): void
    {
        session()->flashInput($input);

        request()->setLaravelSession(session());
    }

    protected function getPackageProviders($app): array
    {
        return [BladeHServiceProvider::class];
    }

    public function assertComponentRenders(string $expected, string $template, array $data = []): void
    {
        self::assertSame($expected, $this->indentedBlade($template, $data));
    }

    public function indentedBlade($template, $data) {
        $indenter = new Indenter();

        $blade = (string) $this->blade($template, $data);
        $indented = $indenter->indent($blade);

        return str_replace(
            [' >', "\n/>", ' </div>', '> ', "\n>"],
            ['>', ' />', "\n</div>", ">\n    ", '>'],
            $indented,
        );
    }
}
