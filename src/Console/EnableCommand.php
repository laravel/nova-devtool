<?php

namespace Laravel\Nova\DevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\PackageManifest;
use Symfony\Component\Console\Attribute\AsCommand;

use function Illuminate\Filesystem\join_paths;

#[AsCommand(name: 'nova:devtool-enable', description: 'Enable Vue DevTool on Laravel Nova', hidden: true)]
class EnableCommand extends Command
{
    use Concerns\InteractsWithProcess;
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
        $webpackFile = join_paths($novaVendorPath, 'webpack.mix.js');

        if (! $filesystem->isDirectory($publicCachePath)) {
            $filesystem->makeDirectory($publicCachePath);

            $filesystem->copyDirectory($publicPath, $publicCachePath);
            $filesystem->put(join_paths($publicCachePath, '.gitignore'), '*');
        }

        if (! $filesystem->isFile($webpackFile)) {
            $filesystem->copy("{$webpackFile}.dist", $webpackFile);
        }

        $this->executeCommand('npm set progress=false && npm ci', $novaVendorPath);
        $filesystem->put("{$novaVendorPath}/node_modules/.gitignore", '*');

        $this->executeCommand('npm set progress=false && npm run dev', $novaVendorPath);

        $this->call('vendor:publish', ['--tag' => 'nova-assets', '--force' => true]);

        return self::SUCCESS;
    }
}
