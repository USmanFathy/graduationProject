<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'first_name'     => 'usman',
            'last_name'     => 'ahmed',
            'username'     => 'usman ahmed',
            'city'        =>'cairo',
            'email'    => 'usmanahmedfathy@gmail.com',
            'country' =>'en',
            'password' => Hash::make('12345678'),
            'phone_number' => '01553524657',
        ]);


    }
}
