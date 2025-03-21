<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::firstOrCreate([
            'email' => 'admin@sauroki.com',
        ],[
            'name' => 'Sauroki User',
            'password' => Hash::make('pass123sauroki'),
            'is_admin' => true,
        ]);
    }
}
