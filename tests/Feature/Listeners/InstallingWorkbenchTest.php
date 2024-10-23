<?php

use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Console\View\Components\Factory as ViewComponent;
use Illuminate\Filesystem\Filesystem;
use Laravel\Nova\DevTool\Listeners\InstallingWorkbench;
use Mockery as m;
use Orchestra\Workbench\Events\InstallStarted;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

it('can make user model and factory if installation without `--basic` option', function () {
    $kernel = m::mock(ConsoleKernel::class);

    $listener = new InstallingWorkbench($kernel, new Filesystem());

    $event = new InstallStarted(
        $input = m::mock(InputInterface::class),
        m::mock(OutputInterface::class),
        m::mock(ViewComponent::class),
    );

    $input->shouldReceive('hasOption')->with('basic')->andReturnTrue();
    $input->shouldReceive('getOption')->with('basic')->andReturnFalse();

    $kernel->shouldReceive('call')->with('make:user-model')->once();
    $kernel->shouldReceive('call')->with('make:user-factory')->once();

    $listener->handle($event);
});

it('can throw exception if installation with `--basic` option', function () {
    $kernel = m::mock(ConsoleKernel::class);

    $listener = new InstallingWorkbench($kernel, new Filesystem());

    $event = new InstallStarted(
        $input = m::mock(InputInterface::class),
        m::mock(OutputInterface::class),
        m::mock(ViewComponent::class),
    );

    $input->shouldReceive('hasOption')->with('basic')->andReturnTrue();
    $input->shouldReceive('getOption')->with('basic')->andReturnTrue();

    $kernel->shouldReceive('call')->with('make:user-model')->never();
    $kernel->shouldReceive('call')->with('make:user-factory')->never();

    $listener->handle($event);
})->throws(RuntimeException::class, 'Nova Devtool does not support installation with --basic` option');
