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
    artisan('nova:partition', ['name' => 'PostCountByUser', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Metrics;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'use Laravel\Nova\Metrics\Partition;',
        'use Laravel\Nova\Metrics\PartitionResult;',
        'class PostCountByUser extends Partition',
        'public function calculate(NovaRequest $request): PartitionResult',
    ], 'app/Nova/Metrics/PostCountByUser.php');
});
