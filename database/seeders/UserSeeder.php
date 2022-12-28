<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Faisal Ramadhan',
            'email' => 'faisalramadhan041201@gmail.com',
            'password' => bcrypt('faisal04#'),
            'mobile' => '085891180613',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'John Smith',
            'email' => 'johnsmith12@gmail.com',
            'password' => bcrypt('john05#'),
            'mobile' => '085877665544',
            'role' => 'admin'
        ]);
    }
}
