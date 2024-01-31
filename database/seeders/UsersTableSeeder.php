<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'status' => 'Administrator',
            ],
            [
                'username' => 'petugas',
                'password' => bcrypt('petugas'),
                'status' => 'Petugas',
            ],
        ];

        DB::table('users')->insert($data);
    }
}
