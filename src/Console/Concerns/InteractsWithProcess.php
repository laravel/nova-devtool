<?php

namespace Laravel\Nova\DevTool\Console\Concerns;

use Symfony\Component\Process\Process;

trait InteractsWithProcess
{
    /**
     * Run the given command as a process.
     */
    protected function executeCommand(string $command, string $path): void
    {
        $process = Process::fromShellCommandline($command, $path)->setTimeout(null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            $process->setTty(true);
        }

        $process->run(function ($type, $line) {
            $this->output->write($line);
        });
    }
}
