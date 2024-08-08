<?php

namespace Laravel\Nova\DevTool\Tests\Feature\Console;

use Orchestra\Testbench\Concerns\InteractsWithPublishedFiles;
use Orchestra\Testbench\Concerns\WithWorkbench;

use function Orchestra\Testbench\package_path;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use InteractsWithPublishedFiles;
    use WithWorkbench;

    /** {@inheritDoc} */
    #[\Override]
    protected function setUp(): void
    {
        if (! defined('TESTBENCH_WORKING_PATH')) {
            define('TESTBENCH_WORKING_PATH', package_path());
        }

        parent::setUp();
    }
}
