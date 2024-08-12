<?php

namespace Laravel\Nova\DevTool;

use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Console\ActionCommand;
use Laravel\Nova\Console\BaseResourceCommand;
use Laravel\Nova\Console\DashboardCommand;
use Laravel\Nova\Console\FilterCommand;
use Laravel\Nova\Console\LensCommand;
use Laravel\Nova\Console\ResourceCommand;
use Orchestra\Workbench\Console\InstallCommand;
use Orchestra\Workbench\Events\InstallEnded;
use Orchestra\Workbench\Events\InstallStarted;

use function Illuminate\Filesystem\join_paths;

class DevToolServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\EnableCommand::class,
            Console\DisableCommand::class,
        ]);

        if (defined('TESTBENCH_WORKING_PATH')) {
            InstallCommand::$configurationBaseFile = join_paths(__DIR__, '..', 'stubs', 'testbench.stub');

            $this->registerActionCommand();
            $this->registerBaseResourceCommand();
            $this->registerDashboardCommand();
            $this->registerFilterCommand();
            $this->registerLensCommand();
            $this->registerResourceCommand();

            $this->commands([
                Console\EnableCommand::class,
                Console\DisableCommand::class,
                Console\ActionCommand::class,
                Console\BaseResourceCommand::class,
                Console\DashboardCommand::class,
                Console\FilterCommand::class,
                Console\LensCommand::class,
                Console\ResourceCommand::class,
            ]);
        }
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerActionCommand()
    {
        $this->app->singleton(ActionCommand::class, function ($app) {
            return new Console\ActionCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerDashboardCommand()
    {
        $this->app->singleton(DashboardCommand::class, function ($app) {
            return new Console\DashboardCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerBaseResourceCommand()
    {
        $this->app->singleton(BaseResourceCommand::class, function ($app) {
            return new Console\BaseResourceCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerFilterCommand()
    {
        $this->app->singleton(FilterCommand::class, function ($app) {
            return new Console\FilterCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerLensCommand()
    {
        $this->app->singleton(LensCommand::class, function ($app) {
            return new Console\LensCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerResourceCommand()
    {
        $this->app->singleton(ResourceCommand::class, function ($app) {
            return new Console\ResourceCommand($app['files']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (
            $this->app->runningInConsole()
            && \defined('TESTBENCH_WORKING_PATH')
        ) {
            tap($this->app->make('events'), function (EventDispatcher $event) {
                $event->listen(InstallStarted::class, [Listeners\InstallingWorkbench::class, 'handle']);
                $event->listen(InstallEnded::class, [Listeners\InstalledWorkbench::class, 'handle']);
            });
        }
    }
}
