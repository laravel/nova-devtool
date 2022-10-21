<?php

namespace Laravel\Nova\DevTool\Console;

use Orchestra\Canvas\Core\Concerns\CodeGenerator;
use Orchestra\Canvas\Core\Concerns\UsesGeneratorOverrides;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'nova:resource', description: 'Create a new resource class')]
class ResourceCommand extends \Laravel\Nova\Console\ResourceCommand
{
    use CodeGenerator;
    use UsesGeneratorOverrides;

    /** {@inheritDoc} */
    #[\Override]
    protected function configure()
    {
        $this->addGeneratorPresetOptions();
    }

    /** {@inheritDoc} */
    #[\Override]
    public function handle()
    {
        return $this->generateCode() ? self::SUCCESS : self::FAILURE;
    }

    /**
     * Run after code successfully generated.
     */
    public function afterCodeHasBeenGenerated(string $className, string $path): void
    {
        $this->callSilent('nova:base-resource', [
            'name' => 'Resource',
            '--preset' => $this->option('preset'),
        ]);
    }

    /** {@inheritDoc} */
    #[\Override]
    protected function getBaseResourceClass()
    {
        $rootNamespace = $this->generatorPreset()->rootNamespace();

        return "{$rootNamespace}Nova\Resource";
    }

    /** {@inheritDoc} */
    #[\Override]
    protected function getModelNamespace()
    {
        return $this->generatorPreset()->modelNamespace();
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
