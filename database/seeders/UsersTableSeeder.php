<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   

    public function run()
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);
    }
}
