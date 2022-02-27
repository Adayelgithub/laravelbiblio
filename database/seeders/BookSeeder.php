<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = Category::pluck('id');

        DB::table("books")->insert([
            "isbn" => $faker->isbn10(),
            "nombre" => "Harry potter y la piedra filosofal",
            "author" => "jk rowling",
            "publisher" => "salamandra",
            "available" => $faker->boolean(true),
            "category_id" => $faker->randomElement($categories),
        ]);

        DB::table("books")->insert([
            "isbn" => $faker->isbn10(),
            "nombre" => "Harry potter y la cámara secreta",
            "author" => "jk rowling",
            "publisher" => "salamandra",
            "available" => $faker->boolean(true),
            "category_id" => $faker->randomElement($categories),
        ]);

        DB::table("books")->insert([
            "isbn" => $faker->isbn10(),
            "nombre" => "Harry potter y el prisionero de azkaban",
            "author" => "jk rowling",
            "publisher" => "salamandra",
            "available" => $faker->boolean(true),
            "category_id" => $faker->randomElement($categories),
        ]);

        DB::table("books")->insert([
            "isbn" => $faker->isbn10(),
            "nombre" => "Harry potter y caliz de fuego",
            "author" => "jk rowling",
            "publisher" => "salamandra",
            "available" => $faker->boolean(true),
            "category_id" => $faker->randomElement($categories),
        ]);

        DB::table("books")->insert([
            "isbn" => $faker->isbn10(),
            "nombre" => "Harry Potter y la Orden del Fénix",
            "author" => "jk rowling",
            "publisher" => "salamandra",
            "available" => $faker->boolean(true),
            "category_id" => $faker->randomElement($categories),
        ]);

        DB::table("books")->insert([
            "isbn" => $faker->isbn10(),
            "nombre" => "Harry Potter y el misterio del príncipe",
            "author" => "jk rowling",
            "publisher" => "salamandra",
            "available" => $faker->boolean(true),
            "category_id" => $faker->randomElement($categories),
        ]);

        DB::table("books")->insert([
            "isbn" => $faker->isbn10(),
            "nombre" => "Harry Potter y las reliquias de la Muerte",
            "author" => "jk rowling",
            "publisher" => "salamandra",
            "available" => $faker->boolean(true),
            "category_id" => $faker->randomElement($categories),
        ]);


        DB::table("books")->insert([
            "isbn" => $faker->isbn10(),
            "nombre" => "El Señor de los Anillos, La Comunidad del Anillo",
            "author" => "J. R. R. Tolkien",
            "publisher" => "George Allen & Unwin",
            "available" => $faker->boolean(true),
            "category_id" => $faker->randomElement($categories),
        ]);

        DB::table("books")->insert([
            "isbn" => $faker->isbn10(),
            "nombre" => "El Señor de los Anillos, Las dos torres",
            "author" => "J. R. R. Tolkien",
            "publisher" => "George Allen & Unwin",
            "available" => $faker->boolean(true),
            "category_id" => $faker->randomElement($categories),
        ]);

        DB::table("books")->insert([
            "isbn" => $faker->isbn10(),
            "nombre" => "El Señor de los Anillos, El retorno del Rey",
            "author" => "J. R. R. Tolkien",
            "publisher" => "George Allen & Unwin",
            "available" => $faker->boolean(true),
            "category_id" => $faker->randomElement($categories),
        ]);
    }
}
