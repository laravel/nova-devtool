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
    artisan('nova:progress', ['name' => 'UsersWithProfile', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Metrics;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'use Laravel\Nova\Metrics\Progress;',
        'use Laravel\Nova\Metrics\ProgressResult;',
        'class UsersWithProfile extends Progress',
        'public function calculate(NovaRequest $request): ProgressResult',
    ], 'app/Nova/Metrics/UsersWithProfile.php');
});
