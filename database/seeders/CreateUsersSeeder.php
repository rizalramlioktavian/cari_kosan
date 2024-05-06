<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'phone' => '0123456789',
            'email' => 'admin@localhost.com',
            'password' =>Hash::make('12345678'),
            'role' => '1',
        ]);


        DB::table('users')->insert([
            'name' => 'User',
            'phone' => '012345678',
            'email' => 'user@telnest.com',
            'password' =>Hash::make('12345678'),
            'role' => '0',
        ]);
    }
}
