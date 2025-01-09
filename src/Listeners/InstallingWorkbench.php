<?php

namespace Laravel\Nova\DevTool\Listeners;

use Illuminate\Filesystem\Filesystem;
use Orchestra\Workbench\Events\InstallStarted;
use RuntimeException;

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
     */
    public function handle(InstallStarted $event): void
    {
        if ($event->isBasicInstallation()) {
            throw new RuntimeException('Nova Devtool does not support installation with --basic` option');
        }
    }
}
