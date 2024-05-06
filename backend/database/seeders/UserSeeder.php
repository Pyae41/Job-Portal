<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'email' => 'admin@hostmm.tech',
            'name' => 'Admin',
            'password' => Hash::make('admin12345'),
            'role' => 'admin',
        ]);

        User::create([
            'email' => 'akn@gmail.com',
            'name' => 'Arkar Nyein',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);
    }
}
