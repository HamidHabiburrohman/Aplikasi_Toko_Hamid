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
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama Tokoku',
            'email' => 'admin@tokoku.com',
            'password' => Hash::make('password'),
            'role' => 'admin', 
        ]);

        // 2. Akun Member Contoh
        User::create([
            'name' => 'Member Standard',
            'email' => 'member@tokoku.com',
            'password' => Hash::make('password'), 
            'role' => 'member', 
        ]);

        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@tokoku.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);
    }
}
