<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CategorySeeder::class);
        $this->call(BookSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);
    }
}
