<?php

namespace Laravel\Nova\DevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\PackageManifest;
use Symfony\Component\Console\Attribute\AsCommand;

use function Orchestra\Sidekick\join_paths;

#[AsCommand(name: 'nova:disable-vue-devtool', description: 'Disable Vue DevTool for Laravel Nova')]
class DisableVueDevToolCommand extends Command
{
    use Concerns\InteractsWithProcess;
    use ConfirmableTrait;

    /** {@inheritDoc} */
    #[\Override]
    protected function configure()
    {
        parent::configure();

        if (defined('TESTBENCH_WORKING_PATH')) {
            $this->setHidden(true);
        }
    }

    /**
     * Execute the console command.
     */
    public function handle(Filesystem $filesystem, PackageManifest $manifest): int
    {
        if (! $this->confirmToProceed()) {
            return self::FAILURE;
        }

        $novaVendorPath = join_paths($manifest->vendorPath, 'laravel', 'nova');

        $publicPath = join_paths($novaVendorPath, 'public');
        $publicCachePath = join_paths($novaVendorPath, 'public-cached');

        if ($filesystem->isDirectory($publicCachePath)) {
            if ($filesystem->isDirectory($publicPath)) {
                $filesystem->deleteDirectory($publicPath);
            }

            $filesystem->delete(join_paths($publicCachePath, '.gitignore'));
            $filesystem->copyDirectory($publicCachePath, $publicPath);
            $filesystem->deleteDirectory($publicCachePath);
        }

        $this->call('vendor:publish', ['--tag' => 'nova-assets', '--force' => true]);

        return self::SUCCESS;
    }
}
