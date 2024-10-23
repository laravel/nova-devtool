<?php

namespace Laravel\Nova\DevTool\Listeners;

use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Filesystem\Filesystem;
use Orchestra\Workbench\Events\InstallStarted;
use Orchestra\Workbench\Workbench;
use RuntimeException;

use function Orchestra\Testbench\join_paths;

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
        if ($event->input->hasOption('basic') && $event->input->getOption('basic') === true) {
            throw new RuntimeException('Nova Devtool does not support installation with --basic` option');
        }

        Workbench::swapFile('config', join_paths(__DIR__, '..', '..', 'stubs', 'testbench.stub'));
        Workbench::swapFile('seeders.database', join_paths(__DIR__, '..', '..', 'stubs', 'DatabaseSeeder.stub'));

        $this->kernel->call('make:user-model');
        $this->kernel->call('make:user-factory');
    }
}
