<?php

namespace Database\Seeders;

use App\Models\User;
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
                'password' => 'admin',
                'status' => 'Administrator',
            ],
            [
                'username' => 'petugas',
                'password' => 'petugas',
                'status' => 'Petugas',
            ],
        ];
        User::insert($data);
    }
}
