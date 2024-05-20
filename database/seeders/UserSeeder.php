<?php

namespace Database\Seeders;

use App\Constants\JabatanEnum;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => Petugas::firstWhere('jabatan', JabatanEnum::PETUGAS_GUDANG_HASIL->value)->nama_petugas,
            'email' => 'hasil@example.com',
            'password' => Hash::make('password'),
            'id_petugas' => Petugas::firstWhere('jabatan', JabatanEnum::PETUGAS_GUDANG_HASIL->value)->id,
        ]);

        User::create([
            'name' => Petugas::firstWhere('jabatan', JabatanEnum::PETUGAS_GUDANG_RETUR->value)->nama_petugas,
            'email' => 'retur@example.com',
            'password' => Hash::make('password'),
            'id_petugas' => Petugas::firstWhere('jabatan', JabatanEnum::PETUGAS_GUDANG_RETUR->value)->id,
        ]);

        User::create([
            'name' => Petugas::firstWhere('jabatan', JabatanEnum::MANAGER->value)->nama_petugas,
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'id_petugas' => Petugas::firstWhere('jabatan', JabatanEnum::MANAGER->value)->id,
        ]);
    }
}
