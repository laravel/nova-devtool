<?php

use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;

use function Orchestra\Testbench\Pest\setUp;
use function Pest\Laravel\artisan;

uses(InteractsWithPublishedFiles::class);

setUp(function ($parent) {
    defineTestbenchPackagePath();

    $parent();

    $this->files = [
        'app/Nova/Filters/*.php',
    ];
});

it('can generate filter file', function () {
    artisan('nova:filter', ['name' => 'Post', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Filters;',
        'use Laravel\Nova\Filters\Filter;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'class Post extends Filter',
        'public $component = \'select-filter\';',
    ], 'app/Nova/Filters/Post.php');
});

it('can generate filter file with boolean type', function () {
    artisan('nova:filter', ['name' => 'Post', '--boolean' => true, '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Filters;',
        'use Laravel\Nova\Filters\BooleanFilter;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'class Post extends BooleanFilter',
    ], 'app/Nova/Filters/Post.php');
});

it('can generate filter file with date type', function () {
    artisan('nova:filter', ['name' => 'Post', '--date' => true, '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Filters;',
        'use Illuminate\Support\Carbon;',
        'use Laravel\Nova\Filters\DateFilter;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'class Post extends DateFilter',
    ], 'app/Nova/Filters/Post.php');
});
