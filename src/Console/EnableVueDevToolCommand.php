<?php

namespace Laravel\Nova\DevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\PackageManifest;
use Symfony\Component\Console\Attribute\AsCommand;

use function Orchestra\Sidekick\join_paths;

#[AsCommand(name: 'nova:enable-vue-devtool', description: 'Enable Vue DevTool for Laravel Nova')]
class EnableVueDevToolCommand extends Command
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
        $webpackFile = join_paths($novaVendorPath, 'webpack.mix.js');

        if (! $filesystem->isDirectory($publicCachePath)) {
            $filesystem->makeDirectory($publicCachePath);

            $filesystem->copyDirectory($publicPath, $publicCachePath);
            $filesystem->put(join_paths($publicCachePath, '.gitignore'), '*');
        }

        if (! $filesystem->isFile($webpackFile)) {
            $filesystem->copy("{$webpackFile}.dist", $webpackFile);
        }

        $this->executeCommand(['npm set progress=false', 'npm ci'], $novaVendorPath);
        $filesystem->put(join_paths($novaVendorPath, 'node_modules', '.gitignore'), '*');

        $this->executeCommand(['npm set progress=false', 'npm run dev'], $novaVendorPath);

        $this->call('vendor:publish', ['--tag' => 'nova-assets', '--force' => true]);

        return self::SUCCESS;
    }
}
