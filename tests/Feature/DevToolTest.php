<?php

use Laravel\Nova\DevTool\DevTool;
use Workbench\App;

it('can detect resources within workbench', function () {
    DevTool::resourcesInWorkbench();

    expect(DevTool::resourceCollection()->all())
        ->toBeArray()
        ->toBe([
            App\Nova\User::class,
        ]);
});
