<?php

use Illuminate\Console\View\Components\Factory as ViewComponent;
use Laravel\Nova\DevTool\Listeners\InstallingWorkbench;
use Mockery as m;
use Orchestra\Workbench\Events\InstallStarted;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

it('can throw exception if installation with `--basic` option', function () {
    $listener = app(InstallingWorkbench::class);
    $event = new InstallStarted(
        $input = m::mock(InputInterface::class),
        m::mock(OutputInterface::class),
        m::mock(ViewComponent::class),
    );

    $input->shouldReceive('hasOption')->with('basic')->andReturnTrue();
    $input->shouldReceive('getOption')->with('basic')->andReturnTrue();

    $listener->handle($event);
})->throws(RuntimeException::class, 'Nova Devtool does not support installation with --basic` option');
