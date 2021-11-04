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
        User::factory(5)->create();
        Publication::factory(20)->create();
        //Image::factory(30)->create();
    }
}
