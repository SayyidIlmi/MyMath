<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Dimas',
                'email' => 'dimas@gmail.com',
                'password' => 'dimasdimas456',
                'email_verified_at' => now(),
                'score' => 0,
                'created_at' => now(),
                'updated_at' => now()
                
            ],
            [
                'name' => 'Arkan',
                'email' => 'arkan@gmail.com',
                'email_verified_at' => now(),
                'password' => 'ArkanArkan456',
                'score' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);    
    }
}
