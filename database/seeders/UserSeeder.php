<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Aguero', // Ganti dengan nama yang diinginkan
            'email' => 'aguero@mail.com', // Ganti dengan email yang diinginkan
            'password' => Hash::make('kunaguero9'), // Ganti dengan password yang diinginkan
            'role' => 'owner', // Pastikan ada kolom role jika Anda menggunakan role
        ]);
    }
}
