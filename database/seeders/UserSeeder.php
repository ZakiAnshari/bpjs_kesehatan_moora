<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Operator'],
            ['name' => 'Pimpinan BPJS'] // Tambahan
        ];

        foreach ($roles as $role) {
            Roles::create($role);
        }

        // Create Users
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'contact' => '082202020202',
            'role_id' => 1,
            'email' => 'admin@example.com',
            'jenis_kelamin' => 'Laki-Laki',
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // Ganti dengan password yang aman
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Operator',
            'username' => 'operator',
            'contact' => '082203030303',
            'role_id' => 2,
            'email' => 'operator@example.com',
            'jenis_kelamin' => 'Perempuan',
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // Ganti dengan password yang aman
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Pimpinan BPJS',
            'username' => 'pimpinan',
            'contact' => '082204040404',
            'role_id' => 3,
            'email' => 'pimpinan@example.com',
            'jenis_kelamin' => 'Laki-Laki',
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // Ganti dengan password yang aman
            'remember_token' => Str::random(10),
        ]);
    }
}
