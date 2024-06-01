<?php

namespace Database\Factories;

use App\Models\Spk;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailSpk>
 */
class DetailSpkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $spk = Spk::factory()->create();
        $qty = random_int(50, 60);

        return [
            'id_spk' => $spk->id,
            'id_buku' => $spk->buku->id,
            'qty' => $qty,
            'stok' => $qty,
            'tanggal' => Carbon::now(),
        ];
    }
}
