<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;    

class memberseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            'name'=>'hamza',
            'email'=>'hamzaabbas7007@gmail.com',
            'password'=>Hash::make('password')
        ]);

        User::Create([
            'name'=>'alihaider',
            'email'=>'ali@gmail.com',
            'password'=>Hash::make('password')
        ]);
    }
}
