<?php

namespace NovaKit\NovaDevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Contracts\Console\PromptsForMissingInput;

#[AsCommand(name: 'nova:devtool', description: 'Configure Laravel Nova DevTool')]
class DevToolCommand extends Command implements PromptsForMissingInput
{
    use Concerns\InteractsWithProcess;
    use ConfirmableTrait;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! $this->confirmToProceed()) {
            return self::FAILURE;
        }

    }
}
