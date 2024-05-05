<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UkuranKertas extends Model
{
    use HasFactory;

    protected $table = 'ukuran_kertas';

    protected $fillable = ['id_grammatur', 'id_kertas_isi', 'ukuran'];

    public function grammatur(): BelongsTo
    {
        return $this->belongsTo(Grammatur::class, 'id_grammatur');
    }

    public function kertasIsi(): BelongsTo
    {
        return $this->belongsTo(KertasIsi::class, 'id_kertas_isi');
    }

    public function detailMaterial(): HasMany
    {
        return $this->hasMany(DetailMaterial::class, 'id_ukuran_kertas');
    }
}
