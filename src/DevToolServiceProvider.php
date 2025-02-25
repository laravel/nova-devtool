<?php

namespace Laravel\Nova\DevTool;

use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Console\ActionCommand;
use Laravel\Nova\Console\BaseResourceCommand;
use Laravel\Nova\Console\DashboardCommand;
use Laravel\Nova\Console\FilterCommand;
use Laravel\Nova\Console\LensCommand;
use Laravel\Nova\Console\PartitionCommand;
use Laravel\Nova\Console\PolicyMakeCommand;
use Laravel\Nova\Console\ProgressCommand;
use Laravel\Nova\Console\RepeatableCommand;
use Laravel\Nova\Console\ResourceCommand;
use Laravel\Nova\Console\TableCommand;
use Laravel\Nova\Console\TrendCommand;
use Laravel\Nova\Console\ValueCommand;
use Orchestra\Workbench\Events\InstallEnded;
use Orchestra\Workbench\Events\InstallStarted;
use Orchestra\Workbench\Workbench;

use function Orchestra\Sidekick\join_paths;

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
            Console\DisableVueDevToolCommand::class,
            Console\EnableVueDevToolCommand::class,
        ]);

        if (defined('TESTBENCH_WORKING_PATH')) {
            Workbench::swapFile('config', join_paths(__DIR__, '..', 'stubs', 'testbench.stub'));
            Workbench::swapFile('seeders.database', join_paths(__DIR__, '..', 'stubs', 'DatabaseSeeder.stub'));

            $this->registerActionCommand();
            $this->registerBaseResourceCommand();
            $this->registerDashboardCommand();
            $this->registerFilterCommand();
            $this->registerLensCommand();
            $this->registerPartitionCommand();
            $this->registerPolicyMakeCommand();
            $this->registerProgressCommand();
            $this->registerRepeatableCommand();
            $this->registerResourceCommand();
            $this->registerTableCommand();
            $this->registerTrendCommand();
            $this->registerValueCommand();

            $this->commands([
                Console\ActionCommand::class,
                Console\BaseResourceCommand::class,
                Console\DashboardCommand::class,
                Console\DevToolCommand::class,
                Console\FilterCommand::class,
                Console\LensCommand::class,
                Console\PartitionCommand::class,
                Console\PolicyMakeCommand::class,
                Console\ProgressCommand::class,
                Console\RepeatableCommand::class,
                Console\ResourceCommand::class,
                Console\TableCommand::class,
                Console\TrendCommand::class,
                Console\ValueCommand::class,
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
     * Register the `nova:partition` command.
     */
    protected function registerPartitionCommand(): void
    {
        $this->app->singleton(PartitionCommand::class, function ($app) {
            return new Console\PartitionCommand($app['files']);
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
     * Register the `nova:progress` command.
     */
    protected function registerProgressCommand(): void
    {
        $this->app->singleton(ProgressCommand::class, function ($app) {
            return new Console\ProgressCommand($app['files']);
        });
    }

    /**
     * Register the `nova:repeatable` command.
     */
    protected function registerRepeatableCommand(): void
    {
        $this->app->singleton(RepeatableCommand::class, function ($app) {
            return new Console\RepeatableCommand($app['files']);
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
     * Register the `nova:table` command.
     */
    protected function registerTableCommand(): void
    {
        $this->app->singleton(TableCommand::class, function ($app) {
            return new Console\TableCommand($app['files']);
        });
    }

    /**
     * Register the `nova:trend` command.
     */
    protected function registerTrendCommand(): void
    {
        $this->app->singleton(TrendCommand::class, function ($app) {
            return new Console\TrendCommand($app['files']);
        });
    }

    /**
     * Register the `nova:value` command.
     */
    protected function registerValueCommand(): void
    {
        $this->app->singleton(ValueCommand::class, function ($app) {
            return new Console\ValueCommand($app['files']);
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
