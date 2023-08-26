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
        User::factory(15)->create();
        User::create([
            'name' => 'Sugiyono',
            'email' => 'ugi@gmail.com',
            'email_verified_at' => now(),
            'role'=>'admin',
            'password' => Hash::make('123456'),
            'phone'=>'089613835657',
            'bio'=>'Junior Programer'
        ]);

        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'role'=>'superadmin',
            'password' => Hash::make('123456'),
            'phone'=>'089613835657',
            'bio'=>'Fullstack Dev'
        ]);
    }
}
