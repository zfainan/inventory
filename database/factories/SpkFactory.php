<?php

namespace Database\Factories;

use App\Models\Buku;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spk>
 */
class SpkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_buku' => Buku::factory()->create()->id,
            'nomor_spk' => Str::orderedUuid()->toString(),
            'tanggal_masuk' => Carbon::now(),
            'tanggal_keluar' => Carbon::now()->addDays(7),
            'oplah_dasar' => random_int(80, 100),
            'oplah_insheet' => random_int(100, 120),
        ];
    }
}
