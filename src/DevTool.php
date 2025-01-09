<?php

namespace Laravel\Nova\DevTool;

use Illuminate\Support\Str;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Nova;
use Laravel\Nova\Resource;
use Orchestra\Workbench\Workbench;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class DevTool extends Nova
{
    /**
     * Register all of the resource classes in the given directory.
     */
    public static function resourcesIn(string $directory): void
    {
        $namespace = Workbench::detectNamespace('app');

        $resources = [];

        foreach ((new Finder)->in($directory)->files() as $resource) {
            $resource = $namespace.str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($resource->getPathname(), Workbench::path('app').DIRECTORY_SEPARATOR)
            );

            if (
                is_subclass_of($resource, Resource::class) &&
                ! (new ReflectionClass($resource))->isAbstract() &&
                ! is_subclass_of($resource, ActionResource::class)
            ) {
                $resources[] = $resource;
            }
        }

        static::resources(
            collect($resources)->sort()->all()
        );
    }

    /**
     * Register all of the resource classes within Workbench.
     */
    public static function resourcesInWorkbench(): void
    {
        static::resourcesIn(Workbench::path(['app', 'Nova']));
    }
}
