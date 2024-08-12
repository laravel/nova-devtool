<?php

use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;

use function Orchestra\Testbench\Pest\setUp;
use function Pest\Laravel\artisan;

uses(InteractsWithPublishedFiles::class);

setUp(function ($parent) {
    defineTestbenchPackagePath();

    $parent();

    $this->files = [
        'app/Nova/Actions/*.php',
    ];
});

it('can generate action file', function () {
    artisan('nova:action', ['name' => 'Sleep', '--preset' => 'laravel'])
            ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Actions;',
        'use Illuminate\Contracts\Queue\ShouldQueue;',
        'use Illuminate\Queue\InteractsWithQueue;',
        'use Laravel\Nova\Actions\Action;',
        'class Sleep extends Action',
        'use InteractsWithQueue;',
        'use Queueable;',
    ], 'app/Nova/Actions/Sleep.php');
});

it('can generate queued action file', function () {
    artisan('nova:action', ['name' => 'Sleep', '--queued' => true, '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Actions;',
        'use Illuminate\Bus\Batchable;',
        'use Illuminate\Bus\PendingBatch;',
        'use Illuminate\Contracts\Queue\ShouldQueue;',
        'use Illuminate\Queue\InteractsWithQueue;',
        'use Illuminate\Queue\SerializesModels;',
        'use Laravel\Nova\Actions\Action;',
        'use Laravel\Nova\Fields\ActionFields;',
        'class Sleep extends Action implements ShouldQueue',
        'use Batchable;',
        'use InteractsWithQueue;',
        'use Queueable;',
        'use SerializesModels;',
        'public function withBatch(ActionFields $fields, PendingBatch $batch)',
    ], 'app/Nova/Actions/Sleep.php');
});

it('can generate destructive action file', function () {
    artisan('nova:action', ['name' => 'Sleep', '--destructive' => true, '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Actions;',
        'use Laravel\Nova\Actions\DestructiveAction;',
        'class Sleep extends DestructiveAction',
    ], 'app/Nova/Actions/Sleep.php');
});

it('can generate queued destructive action file', function () {
    artisan('nova:action', ['name' => 'Sleep', '--queued' => true, '--destructive' => true, '--preset' => 'laravel'])
        ->assertSuccessful();

    $this->assertFileContains([
        'namespace App\Nova\Actions;',
        'use Illuminate\Bus\Batchable;',
        'use Illuminate\Bus\PendingBatch;',
        'use Illuminate\Contracts\Queue\ShouldQueue;',
        'use Illuminate\Queue\InteractsWithQueue;',
        'use Illuminate\Queue\SerializesModels;',
        'use Laravel\Nova\Actions\DestructiveAction;',
        'use Laravel\Nova\Fields\ActionFields;',
        'class Sleep extends DestructiveAction implements ShouldQueue',
        'use Batchable;',
        'use InteractsWithQueue;',
        'use Queueable;',
        'use SerializesModels;',
        'public function withBatch(ActionFields $fields, PendingBatch $batch)',
    ], 'app/Nova/Actions/Sleep.php');
});
