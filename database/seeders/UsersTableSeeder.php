<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name' => 'unit perusahaan',
                'email' => 'unitperusahaan@gmail.com',
                'role' => 'user',
                'password' => Hash::make('unitperusahaan123'),
            ],
            [
                'name' => 'management representative',
                'email' => 'managementrepresentative@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('managementrepresentative123'),
            ],
            [
                'name' => 'direktur',
                'email' => 'direktur@gmail.com',
                'role' => 'superadm',
                'password' => Hash::make('direktur123'),
            ],
            [
                'name' => 'sekretaris',
                'email' => 'sekretaris@gmail.com',
                'role' => 'sekretaris',
                'password' => Hash::make('sekretaris123'),
            ],
        ];

        foreach ($userData as $userData) {
            // Periksa apakah data sudah ada sebelum mencoba membuatnya
            if (!DB::table('users')->where('email', $userData['email'])->exists()) {
                DB::table('users')->insert($userData);
            }
        }
    }
}
