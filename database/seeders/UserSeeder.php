<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
           'name' => 'admin',
        ]);

        DB::table('role')->insert([
            'name' => 'user',
        ]);

        DB::table('role')->insert([
            'name' => 'chef',
        ]);


        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);
    }
}
