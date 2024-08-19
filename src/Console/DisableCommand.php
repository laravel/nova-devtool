<?php

namespace Laravel\Nova\DevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\PackageManifest;
use Symfony\Component\Console\Attribute\AsCommand;

use function Illuminate\Filesystem\join_paths;

#[AsCommand(name: 'nova:devtool-disable', description: 'Disable Vue DevTool on Laravel Nova', hidden: true)]
class DisableCommand extends Command
{
    use ConfirmableTrait;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Filesystem $filesystem, PackageManifest $manifest)
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
