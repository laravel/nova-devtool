<?php

namespace Laravel\Nova\DevTool\Console\Concerns;

use Illuminate\Support\Arr;
use Symfony\Component\Process\Process;

trait InteractsWithProcess
{
    /**
     * Run the given command as a process.
     */
    protected function executeCommand(array|string $command, string $path): void
    {
        $process = Process::fromShellCommandline(implode(' && ', Arr::wrap($command)), $path)->setTimeout(null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            $process->setTty(true);
        }

        $process->run(function ($type, $line) {
            $this->output->write($line);
        });
    }
}
