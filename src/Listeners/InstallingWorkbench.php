<?php

namespace Laravel\Nova\DevTool\Listeners;

use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Filesystem\Filesystem;
use Orchestra\Workbench\Events\InstallStarted;

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
        $this->kernel->call('make:user-model');
        $this->kernel->call('make:user-factory');
    }
}
