<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            "first_name" => "Admintration",
            "last_name" => "Admin",
            "gender" => "m",
            "phone" => "9632587410",
            "email" => "admin@trendora.com",
            "password" => Hash::make("123456"),
            "confirmation_password" => Hash::make("123456"),
            "role" => "admin",
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('registration')->insert($user);
    }
}
