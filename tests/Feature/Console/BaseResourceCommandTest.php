<?php

use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;

use function Orchestra\Testbench\Pest\setUp;
use function Pest\Laravel\artisan;

uses(InteractsWithPublishedFiles::class);

setUp(function ($parent) {
    defineTestbenchPackagePath();

    $parent();

    $this->files = [
        'app/Nova/*.php',
    ];
});

it('can generate resource file', function () {
    artisan('nova:base-resource', ['name' => 'Resource', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'use Laravel\Nova\Resource as NovaResource;',
        'class Resource extends NovaResource',
    ], 'app/Nova/Resource.php');
});
