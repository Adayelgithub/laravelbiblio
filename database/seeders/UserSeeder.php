<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
       // DB::table('users')->truncate();
        $admin = User::create([
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'email' => "admin@admin.es",
            'rol_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $cliente1 = User::create([
            'name' => 'aday',
            'password' => Hash::make('aday'),
            'email' => "aday@cliente.es",
            'rol_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $cliente2 = User::create([
            'name' => 'jose',
            'password' => Hash::make('jose'),
            'email' => "jose@cliente.es",
            'rol_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $admin->assignRole('admin');
        $cliente1->assignRole('cliente');
        $cliente2->assignRole('cliente');

       // DB::table('users')->insert($admin);
       // DB::table('users')->insert($cliente1);
       // DB::table('users')->insert($cliente2);
    }
}
