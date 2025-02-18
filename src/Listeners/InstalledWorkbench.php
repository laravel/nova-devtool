<?php

namespace Laravel\Nova\DevTool\Listeners;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Orchestra\Testbench\Foundation\Console\Actions\EnsureDirectoryExists;
use Orchestra\Testbench\Foundation\Console\Actions\GeneratesFile;
use Orchestra\Workbench\Events\InstallEnded;
use Orchestra\Workbench\StubRegistrar;
use Orchestra\Workbench\Workbench;

use function Orchestra\Sidekick\join_paths;

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
     */
    public function handle(InstallEnded $event): void
    {
        $force = false;

        if ($event->input->hasOption('force')) {
            $force = $event->input->getOption('force');
        }

        $workingDirectory = realpath(__DIR__.'/../../stubs');

        (new EnsureDirectoryExists(
            filesystem: $this->files,
            components: $event->components,
        ))->handle([
            Workbench::path(['app', 'Nova']),
            Workbench::path(['app', 'Providers']),
        ]);

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            force: $force,
        ))->handle(
            join_paths($workingDirectory, 'base-resource.stub'),
            $baseResource = Workbench::path(['app', 'Nova', 'Resource.php'])
        );

        StubRegistrar::replaceInFile($this->files, $baseResource);

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            force: $force,
        ))->handle(
            join_paths($workingDirectory, 'user-resource.stub'),
            $userResource = Workbench::path(['app', 'Nova', 'User.php'])
        );

        StubRegistrar::replaceInFile($this->files, $userResource);

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            force: $force,
        ))->handle(
            join_paths($workingDirectory, 'NovaServiceProvider.stub'),
            $serviceProvider = Workbench::path(['app', 'Providers', 'NovaServiceProvider.php'])
        );

        StubRegistrar::replaceInFile($this->files, $serviceProvider);

        Collection::make([
            Workbench::path(['app', '.gitkeep']),
            Workbench::path(['app', 'Models', '.gitkeep']),
            Workbench::path(['app', 'Nova', '.gitkeep']),
            Workbench::path(['app', 'Providers', '.gitkeep']),
            Workbench::path(['database', 'seeders', '.gitkeep']),
        ])->each(function ($file) {
            $this->files->delete($file);
        });
    }
}
