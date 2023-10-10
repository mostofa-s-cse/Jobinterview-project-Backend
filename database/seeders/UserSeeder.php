<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => "Owner",
            'email' => "owner@gmail.com",
            'password' => Hash::make('1234'),
            'role'=>'Owner'
        ]);
        $user = User::create([
            'name' => "Shahid",
            'email' => "mostofa@gmail.com",
            'password' => Hash::make('1234'),
            'role'=>'Employee'
        ]);
        $user = User::create([
            'name' => "Mostofa",
            'email' => "mostofa2@gmail.com",
            'password' => Hash::make('1234'),
            'role'=>'Employee'
        ]);
        $user = User::create([
            'name' => "Mostofa",
            'email' => "mostofa3@gmail.com",
            'password' => Hash::make('1234'),
            'role'=>'Employee'
        ]);
    }
}
