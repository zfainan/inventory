<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Penerbit;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(PenerbitSeeder::class);

        $penerbit = Penerbit::all();

        Buku::factory(20)->create([
            'id_penerbit' => $penerbit->random()->id
        ]);
    }
}
