<?php

namespace Laravel\Nova\DevTool\Console;

use Laravel\Nova\Console\ValueCommand as Command;
use Orchestra\Canvas\Core\Concerns\CodeGenerator;
use Orchestra\Canvas\Core\Concerns\UsesGeneratorOverrides;
use Symfony\Component\Console\Attribute\AsCommand;

/**
 * @see Laravel\Nova\Console\ValueCommand
 */
#[AsCommand(name: 'nova:value', description: 'Create a new metric (single value) class')]
class ValueCommand extends Command
{
    use CodeGenerator;
    use UsesGeneratorOverrides;

    /** {@inheritDoc} */
    #[\Override]
    protected function configure()
    {
        $this->addGeneratorPresetOptions();

        parent::configure();
    }

    /** {@inheritDoc} */
    #[\Override]
    public function handle()
    {
        return $this->generateCode() ? self::SUCCESS : self::FAILURE;
    }

    /** {@inheritDoc} */
    #[\Override]
    protected function getPath($name)
    {
        return $this->getPathUsingCanvas($name);
    }

    /** {@inheritDoc} */
    #[\Override]
    protected function rootNamespace()
    {
        return $this->rootNamespaceUsingCanvas();
    }
}
