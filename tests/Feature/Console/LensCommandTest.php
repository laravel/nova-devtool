<?php

use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;

use function Orchestra\Testbench\Pest\setUp;
use function Pest\Laravel\artisan;

uses(InteractsWithPublishedFiles::class);

setUp(function ($parent) {
    defineTestbenchPackagePath();

    $parent();

    $this->files = [
        'app/Nova/Lenses/*.php',
    ];
});

it('can generate lens file', function () {
    artisan('nova:lens', ['name' => 'Post', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Lenses;',
        'use Laravel\Nova\Http\Requests\LensRequest;',
        'use Laravel\Nova\Http\Requests\NovaRequest;',
        'use Laravel\Nova\Lenses\Lens;',
        'class Post extends Lens',
        'public static function query(LensRequest $request, Builder $query): Builder|Paginator',
    ], 'app/Nova/Lenses/Post.php');
});
