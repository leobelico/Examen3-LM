<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Usuario admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'tipo' => 1,
        ]);

        // Usuario becario
        User::create([
            'name' => 'Becario',
            'email' => 'becario@gmail.com',
            'password' => Hash::make('12345678'),
            'tipo' => 2, 
        ]);
    }
}
