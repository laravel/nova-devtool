<?php

namespace Workbench\Database\Seeders;

use Illuminate\Database\Seeder;
use Orchestra\Testbench\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        UserFactory::new()->create([
            'name' => 'Laravel Nova',
            'email' => 'nova@laravel.com',
        ]);

        UserFactory::new()->times(10)->create();
    }
}
