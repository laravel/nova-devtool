<?php

namespace Laravel\Nova\DevTool\Tests\Feature\Console;

class LensCommandTest extends TestCase
{
    /**
     * Stubs files.
     *
     * @var array<int, string>|null
     */
    protected $files = [
        'app/Nova/Lenses/Post.php',
    ];

    public function test_it_can_generate_lens_file()
    {
        $this->artisan('nova:lens', ['name' => 'Post', '--preset' => 'laravel'])
            ->assertSuccessful();

        $this->assertFileContains([
            'namespace App\Nova\Lenses;',
            'use Laravel\Nova\Http\Requests\LensRequest;',
            'use Laravel\Nova\Http\Requests\NovaRequest;',
            'use Laravel\Nova\Lenses\Lens;',
            'class Post extends Lens',
            'public static function query(LensRequest $request, Builder $query): Builder|Paginator',
        ], 'app/Nova/Lenses/Post.php');
    }
}
