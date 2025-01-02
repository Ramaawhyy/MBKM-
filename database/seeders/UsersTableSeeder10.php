<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder10 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Mahasiswa User',
                'email' => 'mahasiswa@example.com',
                'password' => Hash::make('password'), // Use a secure password
                'role' => 'user',
                'nim' => '10000',
            ],
            [
                'name' => 'Dosen User',
                'email' => 'dosen@example.com',
                'password' => Hash::make('password'), // Use a secure password
                'role' => 'dosen',
                'nim' => '1000111',
            ],
            [
                'name' => 'Kaprodi User',
                'email' => 'kaprodi@example.com',
                'password' => Hash::make('password'), // Use a secure password
                'role' => 'superadm',
                'nim' => '11110',
            ],
        ]);
 
    }
}
