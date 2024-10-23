<?php

namespace Laravel\Nova\DevTool\Listeners;

use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Filesystem\Filesystem;
use Orchestra\Workbench\Events\InstallStarted;
use RuntimeException;

class InstallingWorkbench
{
    /**
     * Construct a new event listener.
     */
    public function __construct(
        public ConsoleKernel $kernel,
        public Filesystem $files
    ) {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(InstallStarted $event)
    {
        if ($event->isBasicInstallation()) {
            throw new RuntimeException('Nova Devtool does not support installation with --basic` option');
        }

        $this->kernel->call('make:user-model');
        $this->kernel->call('make:user-factory');
    }
}
