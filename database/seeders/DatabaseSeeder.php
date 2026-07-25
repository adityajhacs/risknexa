<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Company Admin',
            'email' => 'admin@risknexa.com',
            'password' => Hash::make('admin123'),
            'role' => 'company_admin',
            'vendor_id' => null,
        ]);
    }
}