<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'is_super'=>1,
            'password' => Hash::make('admin@123'),
            'created_at'=>'2023-01-06 05:44:50'
        ]);
    }
}
