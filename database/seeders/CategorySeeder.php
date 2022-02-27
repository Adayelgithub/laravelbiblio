<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table("categories")->insert([
            ["nombre" => "Aventuras"],
            ["nombre" => "Cuentos"],
            ["nombre" => "Deporte"],
            ["nombre" => "Fantasía"],
            ["nombre" => "Literatura fantástica"]
        ]);
    }
}
