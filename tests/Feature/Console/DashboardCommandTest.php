<?php

namespace Laravel\Nova\DevTool\Tests\Feature\Console;

class DashboardCommandTest extends TestCase
{
    /**
     * Stubs files.
     *
     * @var array<int, string>|null
     */
    protected $files = [
        'app/Nova/Dashboards/Main.php',
        'app/Nova/Dashboards/Post.php',
    ];

    public function test_it_can_generate_dashboard_file()
    {
        $this->artisan('nova:dashboard', ['name' => 'Post', '--preset' => 'laravel'])
            ->assertSuccessful();

        $this->assertFileContains([
            'namespace App\Nova\Dashboards;',
            'use Laravel\Nova\Dashboard;',
            'class Post extends Dashboard',
        ], 'app/Nova/Dashboards/Post.php');
    }

    public function test_it_can_generate_the_main_dashboard_file()
    {
        $this->artisan('nova:dashboard', ['name' => 'Main', '--preset' => 'laravel'])
            ->assertSuccessful();

        $this->assertFileContains([
            'namespace App\Nova\Dashboards;',
            'use Laravel\Nova\Dashboards\Main as Dashboard;',
            'class Main extends Dashboard',
        ], 'app/Nova/Dashboards/Main.php');
    }
}
