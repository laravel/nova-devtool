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

        $this->replaceInFile($baseResource);

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            force: $force,
        ))->handle(
            join_paths($workingDirectory, 'user-resource.stub'),
            $userResource = Workbench::path(['app', 'Nova', 'User.php'])
        );

        $this->replaceInFile($userResource);

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            force: $force,
        ))->handle(
            join_paths($workingDirectory, 'NovaServiceProvider.stub'),
            $serviceProvider = Workbench::path(['app', 'Providers', 'NovaServiceProvider.php'])
        );

        $this->replaceInFile($serviceProvider);

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

    /**
     * Replace strings in given file.
     */
    protected function replaceInFile(string $filename): void
    {
        $workbenchAppNamespacePrefix = rtrim(Workbench::detectNamespace('app') ?? 'Workbench\App\\', '\\');
        $workbenchFactoriesNamespacePrefix = rtrim(Workbench::detectNamespace('database/factories') ?? 'Workbench\Database\Factories\\', '\\');
        $workbenchSeederNamespacePrefix = rtrim(Workbench::detectNamespace('database/seeders') ?? 'Workbench\Database\Seeders\\', '\\');

        $serviceProvider = sprintf('%s\Providers\WorkbenchServiceProvider', $workbenchAppNamespacePrefix);
        $databaseSeeder = sprintf('%s\DatabaseSeeder', $workbenchSeederNamespacePrefix);
        $userModel = sprintf('%s\Models\User', $workbenchAppNamespacePrefix);
        $userFactory = sprintf('%s\UserFactory', $workbenchFactoriesNamespacePrefix);

        $this->files->replaceInFile(
            [
                '{{WorkbenchAppNamespace}}',
                '{{ WorkbenchAppNamespace }}',
                '{{WorkbenchFactoryNamespace}}',
                '{{ WorkbenchFactoryNamespace }}',
                '{{WorkbenchSeederNamespace}}',
                '{{ WorkbenchSeederNamespace }}',

                '{{WorkbenchServiceProvider}}',
                '{{ WorkbenchServiceProvider }}',
                'Workbench\App\Providers\WorkbenchServiceProvider',

                '{{WorkbenchDatabaseSeeder}}',
                '{{ WorkbenchDatabaseSeeder }}',
                'Workbench\Database\Seeders\DatabaseSeeder',

                '{{WorkbenchUserModel}}',
                '{{ WorkbenchUserModel }}',
                'Workbench\App\Models\User',

                '{{WorkbenchUserFactory}}',
                '{{ WorkbenchUserFactory }}',
                'Workbench\Database\Factories\UserFactory',
            ],
            [
                $workbenchAppNamespacePrefix,
                $workbenchAppNamespacePrefix,
                $workbenchFactoriesNamespacePrefix,
                $workbenchFactoriesNamespacePrefix,
                $workbenchSeederNamespacePrefix,
                $workbenchSeederNamespacePrefix,

                $serviceProvider,
                $serviceProvider,
                $serviceProvider,

                $databaseSeeder,
                $databaseSeeder,
                $databaseSeeder,

                $userModel,
                $userModel,
                $userModel,

                $userFactory,
                $userFactory,
                $userFactory,
            ],
            $filename
        );
    }
}
