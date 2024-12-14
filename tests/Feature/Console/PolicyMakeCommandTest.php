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
        'use App\Nova\Resource;',
        'use Illuminate\Auth\Access\Response;',
        'use Workbench\App\Models\User;',
        'class UserPolicy',
        'public function viewAny(User $user): bool',
        'public function view(User $user, Resource $resource): bool',
        'public function create(User $user): bool',
        'public function update(User $user, Resource $resource): bool',
        'public function delete(User $user, Resource $resource): bool',
        'public function restore(User $user, Resource $resource): bool',
        'public function forceDelete(User $user, Resource $resource): bool',
    ], 'app/Nova/Policies/UserPolicy.php');
});

it('can generate policy file for user resource', function () {
    artisan('nova:policy', ['name' => 'UserPolicy', '--resource' => 'User', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Policies;',
        'use App\Nova\User as UserResource;',
        'use Illuminate\Auth\Access\Response;',
        'use Workbench\App\Models\User;',
        'class UserPolicy',
        'public function viewAny(User $user): bool',
        'public function view(User $user, UserResource $resource): bool',
        'public function create(User $user): bool',
        'public function update(User $user, UserResource $resource): bool',
        'public function delete(User $user, UserResource $resource): bool',
        'public function restore(User $user, UserResource $resource): bool',
        'public function forceDelete(User $user, UserResource $resource): bool',
    ], 'app/Nova/Policies/UserPolicy.php');
});

it('can generate policy file for a resource', function () {
    artisan('nova:policy', ['name' => 'PostPolicy', '--resource' => 'Post', '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Policies;',
        'use App\Nova\Post;',
        'use Illuminate\Auth\Access\Response;',
        'use Workbench\App\Models\User;',
        'class PostPolicy',
        'public function viewAny(User $user): bool',
        'public function view(User $user, Post $post): bool',
        'public function create(User $user): bool',
        'public function update(User $user, Post $post): bool',
        'public function delete(User $user, Post $post): bool',
        'public function restore(User $user, Post $post): bool',
        'public function forceDelete(User $user, Post $post): bool',
    ], 'app/Nova/Policies/PostPolicy.php');
});
