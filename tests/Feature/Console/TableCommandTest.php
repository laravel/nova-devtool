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
    artisan('nova:table', ['name' => 'LatestPost', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Metrics;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'use Laravel\Nova\Metrics\Table;',
        'use Laravel\Nova\Metrics\MetricTableRow;',
        'class LatestPost extends Table',
        'public function calculate(NovaRequest $request): array',
    ], 'app/Nova/Metrics/LatestPost.php');
});
