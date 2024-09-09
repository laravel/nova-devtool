<?php

namespace Laravel\Nova\DevTool\Console;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\PackageManifest;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Symfony\Component\Console\Attribute\AsCommand;

use function Illuminate\Filesystem\join_paths;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;
use function Orchestra\Testbench\default_skeleton_path;
use function Orchestra\Testbench\package_path;

#[AsCommand(name: 'nova:devtool', description: 'Configure Laravel Nova DevTool')]
class DevToolCommand extends Command implements PromptsForMissingInput
{
    use Concerns\InteractsWithProcess;
    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nova:devtool {action}';

    /**
     * Execute the console command.
     */
    public function handle(Filesystem $filesystem, PackageManifest $manifest): int
    {
        if (! $this->confirmToProceed()) {
            return self::FAILURE;
        }

        return match ($action = $this->argument('action')) {
            'install' => $this->installNpmDependencies($filesystem, $manifest),
            'enable-vue-devtool' => $this->enablesVueDevTool($filesystem, $manifest),
            'disable-vue-devtool' => $this->disablesVueDevTool($filesystem, $manifest),
            default => throw new InvalidArgumentException(sprintf('Unable to handle [%s] action', $action)),
        };
    }

    /**
     * Install NPM dependencies.
     */
    protected function installNpmDependencies(Filesystem $filesystem, PackageManifest $manifest): int
    {
        $novaTailwindConfigFile = join_paths($manifest->vendorPath, 'laravel', 'nova', 'tailwind.config.js');

        if (str_starts_with($novaTailwindConfigFile, default_skeleton_path())) {
            $novaTailwindConfigFile = './'.ltrim(Str::after($novaTailwindConfigFile, default_skeleton_path()), DIRECTORY_SEPARATOR);
        } elseif (str_starts_with($novaTailwindConfigFile, package_path())) {
            $novaTailwindConfigFile = './'.ltrim(Str::after($novaTailwindConfigFile, package_path()), DIRECTORY_SEPARATOR);
        }

        $dependencies = multiselect(
            label: 'Dependencies to install?',
            options: ['axios', 'lodash', 'tailwindcss', 'vue'],
            default: [],
        );

        if (empty($dependencies)) {
            $this->components->info('Nothing to install');

            return self::SUCCESS;
        }

        $this->executeCommand([
            'npm set progress=false',
            'npm install --dev '.implode(' ', $dependencies),
        ], package_path());

        $filesystem->copy(join_paths(__DIR__, 'stubs', 'tsconfig.json'), package_path('tsconfig.json'));

        if (in_array('tailwindcss', $dependencies)) {
            $filesystem->copy(join_paths(__DIR__, 'stubs', 'postcss.config.js'), package_path('postcss.config.js'));
            $filesystem->copy(join_paths(__DIR__, 'stubs', 'tailwind.config.js'), package_path('tailwind.config.js'));
            $filesystem->replaceInFile([
                '{{novaTailwindConfigFile}}',
            ], [
                str_replace(DIRECTORY_SEPARATOR, '/', $novaTailwindConfigFile),
            ], package_path('tailwind.config.js'));
        }

        return self::SUCCESS;
    }

    /**
     * Enables Vue DevTool.
     */
    protected function enablesVueDevTool(Filesystem $filesystem, PackageManifest $manifest): int
    {
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

    /**
     * Disables Vue DevTool.
     */
    protected function disablesVueDevTool(Filesystem $filesystem, PackageManifest $manifest): int
    {
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

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array<string, \Closure>
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'action' => fn () => select(
                label: 'Which action to be executed?',
                options: [
                    'install' => 'Install NPM Dependencies',
                    'enable-vue-devtool' => 'Enable Vue DevTool',
                    'disable-vue-devtool' => 'Disable Vue DevTool',
                ],
                default: 'owner'
            ),
        ];
    }
}
