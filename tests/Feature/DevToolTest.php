<?php

use Laravel\Nova\DevTool\DevTool;

it('can detect resources within workbench', function () {
    DevTool::resourcesInWorkbench();

    expect(DevTool::resourceCollection()->all())
        ->toBeArray()
        ->toBe([
            \Workbench\App\Nova\User::class,
        ]);
});
