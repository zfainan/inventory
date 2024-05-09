<?php

namespace Database\Seeders;

use App\Models\CetakIsi;
use App\Models\Finishing;
use App\Models\Grammatur;
use App\Models\KertasIsi;
use App\Models\UkuranBuku;
use App\Models\UkuranKertas;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([BukuSeeder::class, DistributorSeeder::class]);

        UkuranBuku::insert([
            ['ukuran_buku' => '14x20'],
            ['ukuran_buku' => '15x20'],
            ['ukuran_buku' => '16x20'],
        ]);

        CetakIsi::insert([
            ['cetak_isi' => 'Satu Warna'],
            ['cetak_isi' => 'Warna Warni'],
        ]);

        Finishing::insert([
            ['finishing' => 'Glossy'],
            ['finishing' => 'Matte'],
        ]);

        KertasIsi::insert([
            ['kertas_isi' => 'Book Paper'],
        ]);

        Grammatur::insert([
            ['grammatur' => '51'],
            ['grammatur' => '52'],
            ['grammatur' => '53'],
        ]);

        Grammatur::all()->each(function ($grammatur) {
            UkuranKertas::create([
                'ukuran' => fake()->randomFloat(2, 80, 90),
                'id_grammatur' => $grammatur->id,
                'id_kertas_isi' => KertasIsi::first()->id,
            ]);
        });
    }
}
