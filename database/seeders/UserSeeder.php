<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'firstname' => 'Danai',
            'lastname' => 'Jantapalaboon',
            'position' => 'FullStack Web Developer',
            'email' => 'danai.athlon@gmail.com',
            'role' => 'Admin',
            'password' => Hash::make(1234),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
