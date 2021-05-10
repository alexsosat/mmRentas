<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User, Publication, Image};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create();
        Publication::factory(5)->create();
        Image::factory(15)->create();
    }
}
