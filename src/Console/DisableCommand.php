<?php

namespace Laravel\Nova\DevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\PackageManifest;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'nova:devtool-disable', description: 'Disable Vue DevTool on Laravel Nova')]
class DisableCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nova:devtool-disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable Vue DevTool on Laravel Nova';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (! $this->confirmToProceed()) {
            return self::FAILURE;
        }

        $filesystem = new Filesystem;
        $manifest = $this->laravel->make(PackageManifest::class);
        $novaVendorPath = $manifest->vendorPath.'/laravel/nova';

        if ($filesystem->isDirectory("{$novaVendorPath}/public-cached")) {
            if ($filesystem->isDirectory("{$novaVendorPath}/public")) {
                $filesystem->deleteDirectory("{$novaVendorPath}/public");
            }

            $filesystem->delete("{$novaVendorPath}/public-cached/.gitignore");
            $filesystem->copyDirectory("{$novaVendorPath}/public-cached", "{$novaVendorPath}/public");
            $filesystem->deleteDirectory("{$novaVendorPath}/public-cached");
        }

        $this->call('vendor:publish', ['--tag' => 'nova-assets', '--force' => true]);

        return self::SUCCESS;
    }
}
