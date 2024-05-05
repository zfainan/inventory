<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KertasIsi extends Model
{
    use HasFactory;

    protected $table = 'kertas_isi';

    protected $fillable = ['kertas_isi'];

    public function ukuranKertas(): HasMany
    {
        return $this->hasMany(UkuranKertas::class, 'id_kertas_isi');
    }
}
