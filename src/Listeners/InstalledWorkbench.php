<?php

namespace Laravel\Nova\DevTool\Listeners;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Orchestra\Testbench\Foundation\Console\Actions\EnsureDirectoryExists;
use Orchestra\Testbench\Foundation\Console\Actions\GeneratesFile;
use Orchestra\Workbench\Events\InstallEnded;
use Orchestra\Workbench\Workbench;

use function Illuminate\Filesystem\join_paths;

class InstalledWorkbench
{
    /**
     * Construct a new event listener.
     */
    public function __construct(public Filesystem $files)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(InstallEnded $event)
    {
        $workingDirectory = realpath(__DIR__.'/../../stubs');

        (new EnsureDirectoryExists(
            filesystem: $this->files,
            components: $event->components,
            workingPath: $workingDirectory,
        ))->handle([
            Workbench::path('app/Nova'),
            Workbench::path('app/Providers'),
        ]);

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            workingPath: $workingDirectory,
        ))->handle(
            join_paths($workingDirectory, 'base-resource.stub'),
            Workbench::path(['app', 'Nova', 'Resource.php'])
        );

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            workingPath: $workingDirectory,
        ))->handle(
            join_paths($workingDirectory, 'UserResource.stub'),
            Workbench::path(['app', 'Nova', 'User.php'])
        );

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            workingPath: $workingDirectory,
        ))->handle(
            join_paths($workingDirectory, 'NovaServiceProvider.stub'),
            Workbench::path(['app', 'Providers', 'NovaServiceProvider.php'])
        );

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            workingPath: $workingDirectory,
        ))->handle(
            join_paths($workingDirectory, 'DatabaseSeeder.stub'),
            Workbench::path(['database', 'seeders', 'DatabaseSeeder.php'])
        );

        Collection::make([
            Workbench::path('app/.gitkeep'),
            Workbench::path('app/Nova/.gitkeep'),
            Workbench::path('app/Providers/.gitkeep'),
            Workbench::path('database/seeders/.gitkeep'),
        ])->each(function ($file) {
            $this->files->delete($file);
        });
    }
}