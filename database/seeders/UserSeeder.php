<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'Anhtu2',
            'email'=>'anhtu2@gmail.com',
            'password'=>Hash::make('12345'),
            'role_id'=>'3',
        ]);
    }
}
