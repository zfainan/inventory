<?php

namespace Database\Seeders;

use App\Constants\JenisGudang;
use App\Models\Gudang;
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
                'jenis' => JenisGudang::GUDANG_HASIL->value,
            ],
            [
                'nama' => 'Gudang Hasil',
            ]
        );

        Gudang::firstOrCreate(
            [
                'jenis' => JenisGudang::GUDANG_RETUR->value,
            ],
            [
                'nama' => 'Gudang Retur',
            ]
        );
    }
}
