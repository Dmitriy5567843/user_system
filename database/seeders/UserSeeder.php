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
         User::factory()->create([
             'name' => 'Admin',
             'email' => 'test-admin@example.com',
             'password' => Hash::make(123),
             'role' => 'admin'
         ]);

         User::factory()->create([
             'name' => 'User',
             'email' => 'test-user@example.com',
             'password' => Hash::make(123),
             'role' => 'user'
         ]);

         User::factory()->create([
             'name' => 'User1',
             'email' => 'test1-user@example.com',
             'password' => Hash::make(123),
             'role' => 'user'
         ]);

         User::factory()->create([
             'name' => 'User2',
             'email' => 'test2-user@example.com',
             'password' => Hash::make(123),
             'role' => 'user'
         ]);
    }
}
