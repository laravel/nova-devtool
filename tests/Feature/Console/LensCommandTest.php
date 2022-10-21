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

    /** @test */
    public function it_can_generate_lens_file()
    {
        $this->artisan('nova:lens', ['name' => 'Post', '--preset' => 'laravel'])
            ->assertSuccessful();

        $this->assertFileContains([
            'namespace App\Nova\Lenses;',
            'use Laravel\Nova\Http\Requests\LensRequest;',
            'use Laravel\Nova\Http\Requests\NovaRequest;',
            'use Laravel\Nova\Lenses\Lens;',
            'class Post extends Lens',
            'public static function query(LensRequest $request, $query)',
        ], 'app/Nova/Lenses/Post.php');
    }
}
