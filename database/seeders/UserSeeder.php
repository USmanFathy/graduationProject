<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name'     => 'usman ahmed',
            'email'    => 'anas@gmail.com',
            'username'    => 'anas',
            'super_admin'    => true,
            'password' => Hash::make('12345678'),
            'phone_number' => '01553524657',
        ]);


    }
}
