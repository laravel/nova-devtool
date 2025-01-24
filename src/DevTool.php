<?php

namespace Laravel\Nova\DevTool;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
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

        /** @var array<int, class-string<\Laravel\Nova\Resource>> $resources */
        $resources = [];

        $gate = app(GateContract::class);

        foreach ((new Finder)->in($directory)->files() as $resource) {
            /** @var class-string<\Laravel\Nova\Resource> $resourceClass */
            $resourceClass = $namespace.str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($resource->getPathname(), Workbench::path('app').DIRECTORY_SEPARATOR)
            );

            if (
                is_subclass_of($resourceClass, Resource::class) &&
                ! (new ReflectionClass($resourceClass))->isAbstract() &&
                ! is_subclass_of($resourceClass, ActionResource::class)
            ) {
                $resources[] = $resourceClass;
            }

            if (property_exists($resourceClass, 'policy') && ! is_null($resourceClass::$policy)) {
                $gate->policy($resourceClass, $resourceClass::$policy);
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
