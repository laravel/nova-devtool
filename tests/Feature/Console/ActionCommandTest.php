<?php

namespace Laravel\Nova\DevTool\Tests\Feature\Console;

class ActionCommandTest extends TestCase
{
    /**
     * Stubs files.
     *
     * @var array<int, string>|null
     */
    protected $files = [
        'app/Nova/Actions/Sleep.php',
    ];

    public function test_it_can_generate_action_file()
    {
        $this->artisan('nova:action', ['name' => 'Sleep', '--preset' => 'laravel'])
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
    }

    public function test_it_can_generate_queued_action_file()
    {
        $this->artisan('nova:action', ['name' => 'Sleep', '--queued' => true, '--preset' => 'laravel'])
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
    }

    public function test_it_can_generate_destructive_action_file()
    {
        $this->artisan('nova:action', ['name' => 'Sleep', '--destructive' => true, '--preset' => 'laravel'])
            ->assertSuccessful();

        $this->assertFileContains([
            'namespace App\Nova\Actions;',
            'use Laravel\Nova\Actions\DestructiveAction;',
            'class Sleep extends DestructiveAction',
        ], 'app/Nova/Actions/Sleep.php');
    }

    public function test_it_can_generate_queued_destructive_action_file()
    {
        $this->artisan('nova:action', ['name' => 'Sleep', '--queued' => true, '--destructive' => true, '--preset' => 'laravel'])
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
    }
}
