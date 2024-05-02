<?php

namespace Database\Seeders;

use App\Constants\JabatanEnum;
use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Petugas::create([
            'nama_petugas' => fake()->name,
            'jabatan' => JabatanEnum::PETUGAS_GUDANG_HASIL->value,
        ]);
        Petugas::create([
            'nama_petugas' => fake()->name,
            'jabatan' => JabatanEnum::PETUGAS_GUDANG_RETUR->value,
        ]);
    }
}
