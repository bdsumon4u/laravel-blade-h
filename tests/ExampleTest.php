<?php

namespace Tests;

use Hotash\BladeH\Providers\BladeHServiceProvider;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [BladeHServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        self::assertTrue(true);
    }
}
