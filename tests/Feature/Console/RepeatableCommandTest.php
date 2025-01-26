<?php

use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;

use function Orchestra\Testbench\Pest\setUp;
use function Pest\Laravel\artisan;

uses(InteractsWithPublishedFiles::class);

setUp(function ($parent) {
    defineTestbenchPackagePath();

    $parent();

    $this->files = [
        'app/Nova/Repeaters/*.php',
    ];
});

it('can generate metrics file', function () {
    artisan('nova:repeatable', ['name' => 'CountryVisit', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Repeaters;',
        'use Laravel\Nova\Fields\Repeater\Repeatable;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'class CountryVisit extends Repeatable',
        'public function fields(NovaRequest $request): array',
    ], 'app/Nova/Repeaters/CountryVisit.php');
});
