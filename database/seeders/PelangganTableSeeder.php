<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelangganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'namaPelanggan' => 'Donny',
                'alamat' => 'Malaka',
                'noTelp' => '081264845417',
            ],
            [
                'namaPelanggan' => 'Verrel',
                'alamat' => 'Cipayung',
                'noTelp' => '082949131241',
            ],
        ];
        Pelanggan::insert($data);
    }
}
