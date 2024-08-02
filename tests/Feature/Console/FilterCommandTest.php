<?php

namespace Laravel\Nova\DevTool\Tests\Feature\Console;

class FilterCommandTest extends TestCase
{
    /**
     * Stubs files.
     *
     * @var array<int, string>|null
     */
    protected $files = [
        'app/Nova/Filters/Post.php',
    ];

    public function test_it_can_generate_filter_file()
    {
        $this->artisan('nova:filter', ['name' => 'Post', '--preset' => 'laravel'])
            ->assertSuccessful();

        $this->assertFileContains([
            'namespace App\Nova\Filters;',
            'use Laravel\Nova\Filters\Filter;',
            'use Laravel\Nova\Http\Requests\NovaRequest;',
            'class Post extends Filter',
            'public $component = \'select-filter\';',
        ], 'app/Nova/Filters/Post.php');
    }

    public function test_it_can_generate_filter_file_with_boolean_type()
    {
        $this->artisan('nova:filter', ['name' => 'Post', '--boolean' => true, '--preset' => 'laravel'])
            ->assertSuccessful();

        $this->assertFileContains([
            'namespace App\Nova\Filters;',
            'use Laravel\Nova\Filters\BooleanFilter;',
            'use Laravel\Nova\Http\Requests\NovaRequest;',
            'class Post extends BooleanFilter',
        ], 'app/Nova/Filters/Post.php');
    }

    public function test_it_can_generate_filter_file_with_date_type()
    {
        $this->artisan('nova:filter', ['name' => 'Post', '--date' => true, '--preset' => 'laravel'])
            ->assertSuccessful();

        $this->assertFileContains([
            'namespace App\Nova\Filters;',
            'use Illuminate\Support\Carbon;',
            'use Laravel\Nova\Filters\DateFilter;',
            'use Laravel\Nova\Http\Requests\NovaRequest;',
            'class Post extends DateFilter',
        ], 'app/Nova/Filters/Post.php');
    }
}
