<?php

namespace Laravel\Nova\DevTool;

use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Console\ActionCommand;
use Laravel\Nova\Console\BaseResourceCommand;
use Laravel\Nova\Console\DashboardCommand;
use Laravel\Nova\Console\FilterCommand;
use Laravel\Nova\Console\LensCommand;
use Laravel\Nova\Console\PolicyMakeCommand;
use Laravel\Nova\Console\ResourceCommand;
use Orchestra\Workbench\Events\InstallEnded;
use Orchestra\Workbench\Events\InstallStarted;
use Orchestra\Workbench\Workbench;

use function Illuminate\Filesystem\join_paths;

class DevToolServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\DevToolCommand::class,
        ]);

        if (defined('TESTBENCH_WORKING_PATH')) {
            Workbench::swapFile('config', join_paths(__DIR__, '..', 'stubs', 'testbench.stub'));
            Workbench::swapFile('seeders.database', join_paths(__DIR__, '..', 'stubs', 'DatabaseSeeder.stub'));

            $this->registerActionCommand();
            $this->registerBaseResourceCommand();
            $this->registerDashboardCommand();
            $this->registerFilterCommand();
            $this->registerLensCommand();
            $this->registerPolicyMakeCommand();
            $this->registerResourceCommand();

            $this->commands([
                Console\ActionCommand::class,
                Console\BaseResourceCommand::class,
                Console\DashboardCommand::class,
                Console\FilterCommand::class,
                Console\LensCommand::class,
                Console\PolicyMakeCommand::class,
                Console\ResourceCommand::class,
            ]);
        }
    }

    /**
     * Register the `nova:action` command.
     */
    protected function registerActionCommand(): void
    {
        $this->app->singleton(ActionCommand::class, function ($app) {
            return new Console\ActionCommand($app['files']);
        });
    }

    /**
     * Register the `nova:dashboard` command.
     */
    protected function registerDashboardCommand(): void
    {
        $this->app->singleton(DashboardCommand::class, function ($app) {
            return new Console\DashboardCommand($app['files']);
        });
    }

    /**
     * Register the `nova:base-resource` command.
     */
    protected function registerBaseResourceCommand(): void
    {
        $this->app->singleton(BaseResourceCommand::class, function ($app) {
            return new Console\BaseResourceCommand($app['files']);
        });
    }

    /**
     * Register the `nova:filter` command.
     */
    protected function registerFilterCommand(): void
    {
        $this->app->singleton(FilterCommand::class, function ($app) {
            return new Console\FilterCommand($app['files']);
        });
    }

    /**
     * Register the `nova:lens` command.
     */
    protected function registerLensCommand(): void
    {
        $this->app->singleton(LensCommand::class, function ($app) {
            return new Console\LensCommand($app['files']);
        });
    }

    /**
     * Register the `nova:policy` command.
     */
    protected function registerPolicyMakeCommand(): void
    {
        $this->app->singleton(PolicyMakeCommand::class, function ($app) {
            return new Console\PolicyMakeCommand($app['files']);
        });
    }

    /**
     * Register the `nova:resource` command.
     */
    protected function registerResourceCommand(): void
    {
        $this->app->singleton(ResourceCommand::class, function ($app) {
            return new Console\ResourceCommand($app['files']);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole() && defined('TESTBENCH_CORE')) {
            tap($this->app->make('events'), function (EventDispatcher $event) {
                $event->listen(InstallStarted::class, [Listeners\InstallingWorkbench::class, 'handle']);
                $event->listen(InstallEnded::class, [Listeners\InstalledWorkbench::class, 'handle']);
            });
        }
    }
}
