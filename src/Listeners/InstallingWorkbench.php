<?php

namespace Laravel\Nova\DevTool\Listeners;

use Illuminate\Filesystem\Filesystem;
use Orchestra\Testbench\Foundation\Console\Actions\GeneratesFile;
use Orchestra\Workbench\Events\InstallStarted;
use Orchestra\Workbench\Workbench;

class InstallingWorkbench
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem;
     */
    public $files;

    /**
     * Construct a new event listener.
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
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
            $workingDirectory.DIRECTORY_SEPARATOR.'testbench.stub',
            Workbench::packagePath('testbench.yaml')
        );
    }
}
