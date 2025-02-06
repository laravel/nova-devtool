<?php

use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;

use function Orchestra\Testbench\Pest\setUp;
use function Pest\Laravel\artisan;

uses(InteractsWithPublishedFiles::class);

setUp(function ($parent) {
    defineTestbenchPackagePath();

    $parent();

    $this->files = [
        'app/Nova/Metrics/*.php',
    ];
});

it('can generate metrics file', function () {
    artisan('nova:value', ['name' => 'PostCount', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Metrics;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'use Laravel\Nova\Metrics\Value;',
        'use Laravel\Nova\Metrics\ValueResult;',
        'class PostCount extends Value',
        'public function calculate(NovaRequest $request): ValueResult',
    ], 'app/Nova/Metrics/PostCount.php');
});
