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
    artisan('nova:trend', ['name' => 'PostCountOverTime', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Metrics;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'use Laravel\Nova\Metrics\Trend;',
        'use Laravel\Nova\Metrics\TrendResult;',
        'class PostCountOverTime extends Trend',
        'public function calculate(NovaRequest $request): TrendResult',
    ], 'app/Nova/Metrics/PostCountOverTime.php');
});
