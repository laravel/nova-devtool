<?php

use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;

use function Orchestra\Testbench\Pest\setUp;
use function Pest\Laravel\artisan;

uses(InteractsWithPublishedFiles::class);

setUp(function ($parent) {
    defineTestbenchPackagePath();

    $parent();

    $this->files = [
        'app/Nova/Dashboards/*.php',
    ];
});

it('can generate dashboard file', function () {
    artisan('nova:dashboard', ['name' => 'Post', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Dashboards;',
        'use Laravel\Nova\Dashboard;',
        'class Post extends Dashboard',
    ], 'app/Nova/Dashboards/Post.php');
});

it('can generate the main dashboard file', function () {
    artisan('nova:dashboard', ['name' => 'Main', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Dashboards;',
        'use Laravel\Nova\Dashboards\Main as Dashboard;',
        'class Main extends Dashboard',
    ], 'app/Nova/Dashboards/Main.php');
});
