<?php

namespace Laravel\Nova\DevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\PackageManifest;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'nova:devtool-enable', description: 'Enable Vue DevTool on Laravel Nova')]
class EnableCommand extends Command
{
    use Concerns\InteractsWithProcess;
    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nova:devtool-enable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable Vue DevTool on Laravel Nova';

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

        $filesystem = new Filesystem();
        $manifest = $this->laravel->make(PackageManifest::class);
        $novaVendorPath = $manifest->vendorPath.'/laravel/nova';

        if (! $filesystem->isDirectory("{$novaVendorPath}/public-cached")) {
            $filesystem->makeDirectory("{$novaVendorPath}/public-cached");

            $filesystem->copyDirectory("{$novaVendorPath}/public", "{$novaVendorPath}/public-cached");
            $filesystem->put("{$novaVendorPath}/public-cached/.gitignore", '*');
        }

        if (! $filesystem->isFile("{$novaVendorPath}/webpack.mix.js")) {
            $filesystem->copy("{$novaVendorPath}/webpack.mix.js.dist", "{$novaVendorPath}/webpack.mix.js");
        }

        $this->executeCommand('npm set progress=false && npm ci', $novaVendorPath);
        $filesystem->put("{$novaVendorPath}/node_modules/.gitignore", '*');

        $this->executeCommand('npm set progress=false && npm run dev', $novaVendorPath);

        $this->call('vendor:publish', ['--tag' => 'nova-assets', '--force' => true]);

        return self::SUCCESS;
    }
}
