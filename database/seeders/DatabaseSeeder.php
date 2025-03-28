<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        Member::create([
            'name' => 'Bill Yerds',
            'gender' => 'male',
            'phone' => '0789326245',
            'email' => 'tambajj@gmail.com',
            'status' => 'active',
        ]);
    }
}
