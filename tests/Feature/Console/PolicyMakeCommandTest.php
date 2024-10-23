<?php

use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;

use function Orchestra\Testbench\Pest\setUp;
use function Pest\Laravel\artisan;

uses(InteractsWithPublishedFiles::class);

setUp(function ($parent) {
    defineTestbenchPackagePath();

    $parent();

    $this->files = [
        'app/Nova/Policies/*.php',
    ];
});

it('can generate policy file', function () {
    artisan('nova:policy', ['name' => 'UserPolicy', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Policies;',
        'use Illuminate\Auth\Access\Response;',
        'use Illuminate\Foundation\Auth\User;',
        'class UserPolicy',
    ], 'app/Nova/Policies/UserPolicy.php');
});
