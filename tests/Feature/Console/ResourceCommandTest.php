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
    artisan('nova:resource', ['name' => 'Post', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova;',
        'class Post extends Resource',
        'public static $model = \App\Models\Post::class;',
    ], 'app/Nova/Post.php');

    $this->assertFileContains([
        'namespace App\Nova;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'use Laravel\Nova\Resource as NovaResource;',
        'class Resource extends NovaResource',
    ], 'app/Nova/Resource.php');
});
