<?php

namespace Laravel\Nova\DevTool\Listeners;

use Illuminate\Filesystem\Filesystem;
use Orchestra\Testbench\Foundation\Console\Actions\GeneratesFile;
use Orchestra\Workbench\Events\InstallStarted;
use Orchestra\Workbench\Workbench;

use function Illuminate\Filesystem\join_paths;

class InstallingWorkbench
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
    public function handle(InstallStarted $event)
    {
        $workingDirectory = realpath(__DIR__.'/../../stubs');

        (new GeneratesFile(
            filesystem: $this->files,
            components: $event->components,
            workingPath: $workingDirectory,
        ))->handle(
            join_paths($workingDirectory, 'testbench.stub'),
            Workbench::packagePath('testbench.yaml')
        );
    }
}
