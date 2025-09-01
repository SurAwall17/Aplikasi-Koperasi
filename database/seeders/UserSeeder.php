<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "nik" => "111",
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => Hash::make("superadmin123"),
            "role" => "admin"
        ]);
        User::create([
            "nik" => "222",
            "name" => "Surawal",
            "email" => "surawal@gmail.com",
            "password" => Hash::make("surawal123"),
            "role" => "user"
        ]);
        User::create([
            "nik" => "333",
            "name" => "Kasriadi",
            "email" => "kasriadi@gmail.com",
            "password" => Hash::make("kasriadi123"),
            "role" => "user"
        ]);
    }
}
