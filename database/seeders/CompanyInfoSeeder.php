<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companyinfo')->insert([
            'name' => 'Your Company Name',
            'about' => 'A brief description of your company',
            'email' => 'your@email.com',
            'address' => '123 Main Street',
            'taxid' => '1234567890123',
            'tel_1' => '1234567890',
            'tel_2' => null,
            'fax' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
