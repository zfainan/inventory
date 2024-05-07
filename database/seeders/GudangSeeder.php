<?php

namespace Database\Seeders;

use App\Models\Gudang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gudang::firstOrCreate(
            [
                'jenis' => 'GUDANG_HASIL'
            ],
            [
                'nama' => 'Gudang Hasil'
            ]
        );

        Gudang::firstOrCreate(
            [
                'jenis' => 'GUDANG_RETUR'
            ],
            [
                'nama' => 'Gudang Retur'
            ]
        );
    }
}
